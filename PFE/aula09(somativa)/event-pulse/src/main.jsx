import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import './index.css'
import App from './App.js'
import { ThemeProvider } from './modules/theme/provider/theme.provider'
import { EventProvider } from './modules/event/provider/event.provider'
import { EventFilterProvider } from './modules/event/provider/event-filter.provider'

createRoot(document.getElementById('root')).render(
  <ThemeProvider>
    <EventProvider>
      <EventFilterProvider>
        <StrictMode>
          <App />
        </StrictMode>
      </EventFilterProvider>
    </EventProvider>
  </ThemeProvider>
)
