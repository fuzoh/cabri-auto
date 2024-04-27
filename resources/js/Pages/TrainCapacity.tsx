import {PageProps} from "@/types";
import GenericLayout from "@/Layouts/GenericLayout";
import TrainGraph from "@/Components/TrainGraph";

const TrainCapacity = ({ totalByCity, totalByCityWithBaby, totalByType }) => {

    return (
        <div className="h-full">
            { totalByType.car }
            <TrainGraph totalByCity={totalByCity} totalByType={totalByType} />
        </div>
    );
}

export default TrainCapacity
