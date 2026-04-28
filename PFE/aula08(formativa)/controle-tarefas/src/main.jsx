import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.jsx'
import { TaskFilterProvider } from './provider/task-filter-provider'
import { TaskProvider } from './provider/task-provider'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <TaskProvider>
      <TaskFilterProvider>
        <App />
      </TaskFilterProvider>
    </TaskProvider>
  </StrictMode>
)
