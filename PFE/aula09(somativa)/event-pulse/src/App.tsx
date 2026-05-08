import { useState } from 'react';
import './App.css';
import { EventHeader } from './modules/event/components/event-header/event-header';
import { EventInput } from './modules/event/components/event-input/event-input';
import { EventList } from './modules/event/components/event-list/event-list';
import { EventSearch } from './modules/event/components/event-search/event-search';
import { ChangesModal } from './modules/event/components/event-changes-modal/event-changes-modal';
import iconConfigCss from './assets/favicon_css.png';

function App() {
    const [showModal, setShowModal] = useState(false);

    return (
        <div className="app-container">
            <EventHeader />
            <EventInput />
            <EventSearch />
            <EventList />

            <button className="fab-btn" onClick={() => setShowModal(true)} title="Ver alterações de estilo">
                <img src={iconConfigCss} alt="Info" />
            </button>

            {showModal && <ChangesModal onClose={() => setShowModal(false)} />}
        </div>
    );
}

export default App;
