import {PageProps} from "@/types";
import GenericLayout from "@/Layouts/GenericLayout";
import TrainGraph from "@/Components/TrainGraph";

const TrainCapacity = ({ totalByCity, totalByCityWithBaby, totalByType, totalOnlyPartRecuperation, carTypeCount }) => {

    return (
        <div className="h-full">
            <TrainGraph totalByCity={totalByCity} totalByType={totalByType} onlyPartRecuperation={totalOnlyPartRecuperation} carTypeCount={carTypeCount}/>
        </div>
    );
}

export default TrainCapacity
