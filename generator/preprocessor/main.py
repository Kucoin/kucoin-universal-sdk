import csv

from api_meta import ApiMetaUtil
from meta_tools import MetaTools
from unified_ws_api_template import template_data
from ws_meta import WsMetaUtil

specRoot = "../../spec/"
metaPath = f"{specRoot}/original/meta.json"

def clean_meta():
    tools = MetaTools(metaPath)
    tools.clean()
    tools.write()
    print("clean meta complete!")

def gen_api():
    # parse meta info
    api_collection = ApiMetaUtil.parse(metaPath)

    print(f"api collections: {len(api_collection)}")

    api_group = ApiMetaUtil.group_api(api_collection, False)

    csv_row = []
    for service in api_group:
        apis = api_group[service]
        for i in apis:
            csv_row.append([service[0], service[1],  i['api']['path'], i['api']['method'], i['name']])

    header = ['service', 'subservice', 'path', 'method', 'name']
    with open(f'{specRoot}/apis.csv', mode='w', newline='', encoding='utf-8') as file:
        writer = csv.writer(file)
        writer.writerow(header)
        writer.writerows(csv_row)
    print("generate api list complete!")

    for service in api_group:
        print(f'endpoint: {service}, size: {len(api_group[service])}')
        openapi = ApiMetaUtil.generator_openapi(service, api_group[service], False)
        ApiMetaUtil.write(f"{specRoot}/rest/api/openapi-{service[0]}-{service[1]}.json", openapi)

    api_group = ApiMetaUtil.group_api(api_collection, True)
    for service in api_group:
        print(f'endpoint: {service}, size: {len(api_group[service])}')
        openapi = ApiMetaUtil.generator_openapi(service, api_group[service], True)
        ApiMetaUtil.write(f"{specRoot}/rest/entry/openapi-{service}.json", openapi)
    print("generate api meta complete!")


def gen_ws():
    # parse meta info
    service_map = WsMetaUtil.parse(metaPath)

    csv_row = []
    for service in service_map:
        ws_service = service_map[service]
        for i in ws_service.public.values():
            csv_row.append([service, i.attr['topic'], i.attr['method'], True])
        for i in ws_service.private.values():
            csv_row.append([service, i.attr['topic'], i.attr['method'], False])
    header = ['service', 'topic', 'method', 'pubic']
    with open(f'{specRoot}/ws.csv', mode='w', newline='', encoding='utf-8') as file:
        writer = csv.writer(file)
        writer.writerow(header)
        writer.writerows(csv_row)
    print("generate api list complete!")

    # gen openapi spec file
    for service_name in service_map:
        ws_service = service_map[service_name]
        print(f'ws service: {service_name.lower()}, public size: {len(ws_service.public)}, private size: {len(ws_service.private)}')
        ws_openapi = WsMetaUtil.generator_ws_openapi(service_name, ws_service)
        for openapi in ws_openapi:
            WsMetaUtil.write(f"{specRoot}/ws/openapi-{service_name.lower()}-{openapi[0]}.json", openapi[1])
    print("generate ws meta complete!")

def gen_ws_unified():
    WsMetaUtil.write(f"{specRoot}/ws-unified/openapi-unified-private.json", template_data)
    print("generate ws unified meta complete!")


if __name__ == '__main__':
    clean_meta()
    gen_api()
    gen_ws()
    gen_ws_unified()

