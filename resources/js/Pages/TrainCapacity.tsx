import {PageProps} from "@/types";
import GenericLayout from "@/Layouts/GenericLayout";
import TrainGraph from "@/Components/TrainGraph";

const TrainCapacity = ({ totalByCity, totalByCityWithBaby, totalByType, totalOnlyPartRecuperation }) => {

    return (
        <div className="h-full">
            <TrainGraph totalByCity={totalByCity} totalByType={totalByType} onlyPartRecuperation={totalOnlyPartRecuperation} />
        </div>
    );
}

export default TrainCapacity
