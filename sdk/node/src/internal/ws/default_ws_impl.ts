import { KucoinWSService } from '@api/api_ws';
import { ClientOption } from '@model/client_option';
import { SpotPublicWS, SpotPublicWSImpl } from '@generate/spot/spotpublic/api_spot_public';
import { DomainType } from '@model/constant';
import { SpotPrivateWS, SpotPrivateWSImpl } from '@generate/spot/spotprivate/api_spot_private';
import {
    MarginPublicWS,
    MarginPublicWSImpl,
} from '@generate/margin/marginpublic/api_margin_public';
import {
    MarginPrivateWS,
    MarginPrivateWSImpl,
} from '@generate/margin/marginprivate/api_margin_private';
import {
    FuturesPublicWS,
    FuturesPublicWSImpl,
} from '@generate/futures/futurespublic/api_futures_public';
import {
    FuturesPrivateWS,
    FuturesPrivateWSImpl,
} from '@generate/futures/futuresprivate/api_futures_private';
import { DefaultWsService } from '../infra/default_ws_service';
import { SdkVersion } from '@generate/version';
import { UnifiedPrivateWS, UnifiedPrivateWSImpl } from '@generate/unified/unifiedws/api_unified_private';
import { DefaultWebSocketUnifiedService } from '@internal/infra/default_ws_unified_service';

export class KucoinDefaultWsImpl implements KucoinWSService {
    private readonly options: ClientOption;

    constructor(options: ClientOption) {
        this.options = options;
    }

    newSpotPublicWS(): SpotPublicWS {
        const wsService = new DefaultWsService(this.options, DomainType.Spot, false, SdkVersion);
        return new SpotPublicWSImpl(wsService);
    }

    newSpotPrivateWS(): SpotPrivateWS {
        const wsService = new DefaultWsService(this.options, DomainType.Spot, true, SdkVersion);
        return new SpotPrivateWSImpl(wsService);
    }

    newMarginPublicWS(): MarginPublicWS {
        const wsService = new DefaultWsService(this.options, DomainType.Spot, false, SdkVersion);
        return new MarginPublicWSImpl(wsService);
    }

    newMarginPrivateWS(): MarginPrivateWS {
        const wsService = new DefaultWsService(this.options, DomainType.Spot, true, SdkVersion);
        return new MarginPrivateWSImpl(wsService);
    }

    newFuturesPublicWS(): FuturesPublicWS {
        const wsService = new DefaultWsService(this.options, DomainType.Futures, false, SdkVersion);
        return new FuturesPublicWSImpl(wsService);
    }

    newFuturesPrivateWS(): FuturesPrivateWS {
        const wsService = new DefaultWsService(this.options, DomainType.Futures, true, SdkVersion);
        return new FuturesPrivateWSImpl(wsService);
    }

    newUnifiedPrivateWS(): UnifiedPrivateWS {
        const wsService = new DefaultWebSocketUnifiedService(this.options, SdkVersion);
        return new UnifiedPrivateWSImpl(wsService);
    }
}
