export const useApiUrl = () => {
    const { public: { apiBase } } = useRuntimeConfig();
    return apiBase;
}

export const useApiResourceUrl = (
    path: string,
    page: number,
    perPage: number,
    searchQuery: string,
    sortBy: string,
    sortDirection: string,
) => {
    const url = new URL(`${useApiUrl()}/${path}`);

    url.searchParams.set('page', page.toString());
    url.searchParams.set('perPage', perPage.toString());
    url.searchParams.set('search', searchQuery);
    url.searchParams.set('sortBy', sortBy);
    url.searchParams.set('sortDir', sortDirection);

    return url.toString();
};

