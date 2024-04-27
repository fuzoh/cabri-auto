import {create} from "zustand";

interface StationState {
    stations:
}

const stationStore = create<StationState>(() => ({
    trains: {
        nyonBulle: {
            capacity: 300,
        },
        loadingCities: ['Nyon', 'Morges', 'Lausanne'],

    }
}
