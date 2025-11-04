package com.kucoin.universal.sdk.internal.infra;

import com.kucoin.universal.sdk.internal.interfaces.WebSocketMessageCallback;
import java.util.*;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.ConcurrentMap;
import lombok.Value;
import lombok.extern.slf4j.Slf4j;

@Slf4j
final class CallbackManager {

  /** id → topics set */
  private final ConcurrentMap<String, Set<String>> idTopics = new ConcurrentHashMap<>();

  /** topic → callback */
  private final ConcurrentMap<String, Callback> topicCbs = new ConcurrentHashMap<>();

  private final String topicPrefix;

  CallbackManager(String prefix) {
    this.topicPrefix = prefix;
  }

  boolean empty() {
    return idTopics.isEmpty() && topicCbs.isEmpty();
  }

  boolean add(SubInfo s) {
    // if id already exists -> duplicated subscribe
    Set<String> topicSet = s.topics();
    Set<String> existed = idTopics.putIfAbsent(s.toId(), topicSet);
    if (existed != null) {
      log.trace("callback exists id=[{}]", s.toId());
      return false;
    }
    // register every topic
    for (String t : topicSet) {
      topicCbs.putIfAbsent(t, new Callback(s.getCallback(), s.toId(), t));
    }
    return true;
  }

  void remove(String id) {
    Set<String> topics = idTopics.remove(id);
    if (topics == null) return;
    topics.forEach(topicCbs::remove);
  }

  WebSocketMessageCallback get(String topic) {
    Callback cb = topicCbs.get(topic);
    return cb == null ? null : cb.callback;
  }

  List<SubInfo> getSubInfo() {
    List<SubInfo> list = new ArrayList<>();

    // one SubInfo per id
    idTopics.forEach(
        (id, topics) -> {
          List<String> args = new ArrayList<>();
          WebSocketMessageCallback cb = null;

          for (String topic : topics) {
            int idx = topic.indexOf(':');
            if (idx != -1) {
              String arg = topic.substring(idx + 1);
              if (!"all".equals(arg)) {
                args.add(arg);
              }
            }
            // pick callback from any topic (they’re identical for this id)
            Callback holder = topicCbs.get(topic);
            if (holder != null) {
              cb = holder.callback;
            }
          }

          list.add(new SubInfo(topicPrefix, args, cb));
        });
    return list;
  }

  @Value
  private static class Callback {
    WebSocketMessageCallback callback;
    String id;
    String topic;
  }
}
