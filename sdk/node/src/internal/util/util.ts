function sleep(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}

export class TimeoutError extends Error {
    constructor(private timeoutMs: number) {
        super(`Timeout after ${timeoutMs}ms`);
    }
}

export function withTimeout<T>(
    executor: (resolve: (value: T) => void, reject: (reason?: any) => void) => void,
    timeoutMs: number,
): Promise<T> {
    return new Promise<T>((outerResolve, outerReject) => {
        let handled = false;
        const timeout = setTimeout(() => {
            if (!handled) {
                handled = true;
                outerReject(new TimeoutError(timeoutMs));
            }
        }, timeoutMs);

        executor(
            (value) => {
                if (!handled) {
                    handled = true;
                    clearTimeout(timeout);
                    outerResolve(value);
                }
            },
            (error) => {
                if (!handled) {
                    handled = true;
                    clearTimeout(timeout);
                    outerReject(error);
                }
            },
        );
    });
}
