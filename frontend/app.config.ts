import type { NuxtApp } from "#app";

interface TokenStorage {
    /**
     * Function to load a token from the storage.
     */
    get: (app: NuxtApp) => Promise<string | undefined>;
    /**
     * Function to save a token to the storage.
     */
    set: (app: NuxtApp, token?: string) => Promise<void>;
}

// LocalStorage example for Laravel Authentication token
const tokenStorageKey = 'sanctum.storage.token';
const localTokenStorage: TokenStorage = {
    get: async () => {
        if (import.meta.server) {
            return undefined;
        }

        console.log("GET token", localStorage.getItem(tokenStorageKey));
        return localStorage.getItem(tokenStorageKey) ?? undefined;
    },

    set: async (app: NuxtApp, token?: string) => {
        if (import.meta.server) {
            return;
        }

        if (!token) {
            localStorage.removeItem(tokenStorageKey);
            return;
        }

        console.log("SET token", token);
        localStorage.setItem(tokenStorageKey, token);
    },
};

export default defineAppConfig({
    sanctum: {
        tokenStorage: localTokenStorage,
    },
});