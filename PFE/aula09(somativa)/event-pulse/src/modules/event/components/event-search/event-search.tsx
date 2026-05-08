import { useEventFilter } from "../../hook/event-filter.hook";

export function EventSearch() {
    const { filter, filterOptions, changeFilter, searchTerm, setSearchTerm } = useEventFilter();

    return (
        <section className="search-section">
            <input
                type="text"
                className="search-input"
                placeholder="🔍 Buscar evento por título..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
            />
            <div className="filter-section">
                {filterOptions.map((f) => (
                    <button
                        key={f}
                        className={filter.filterBy === f ? "active" : ""}
                        onClick={() => changeFilter(f)}
                    >
                        {f}
                    </button>
                ))}
            </div>
        </section>
    );
}
