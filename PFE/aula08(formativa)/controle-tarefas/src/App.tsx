import React, { useState, useEffect } from 'react';
import './App.css';
import { TaskInput } from './components/task-input/task-input';
import { useTaskFilter } from './hook/task-filter-hook';
import { TaskList } from './components/task-list/task-list';
import { TaskSearch } from './components/task-search/task-search';

function App() {
  
  const {filter, filterOptions , changeFilter} = useTaskFilter();

  return (
    <div className="app-container">
      <header>
        <h1>TaskFlow</h1>
        <p>Gestão de Produtividade</p>
      </header>

      <TaskInput />
      <TaskSearch />
      <section className="filter-section">
        {filterOptions.map(f => (
          <button
            key={f}
            className={filter.filterBy === f ? "active" : ""}
            onClick={() => {
              changeFilter(f)
            }}
          >
            {f}
          </button>
        ))}
      </section>

      <TaskList />
    </div>
  );
}

export default App;