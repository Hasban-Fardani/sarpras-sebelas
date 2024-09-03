export const useApiUrl = (
    path: string,
    page: number,
    perPage: number,
    searchQuery: string,
    sortBy: string[],
    sortDirection: string[],
) => {
    const { public: { apiBase } } = useRuntimeConfig();

    const url = new URL(`${apiBase}/${path}`);

    url.searchParams.set('page', page.toString());
    url.searchParams.set('perPage', perPage.toString());
    url.searchParams.set('search', searchQuery);
    url.searchParams.set('sortBy', sortBy.join(','));
    url.searchParams.set('sortDir', sortDirection.join(','));

    return url.toString();
};
