import {PageProps} from "@/types";
import GenericLayout from "@/Layouts/GenericLayout";
import TrainGraph from "@/Components/TrainGraph";

const TrainCapacity = ({
                           totalByCity,
                           totalByCityWithBaby,
                           totalByCityReturnWithParts,
                           totalByType,
                           totalOnlyPartRecuperation,
                           carTypeCount
                       }) => {

    return (
        <div className="h-full">
            <TrainGraph totalByCity={totalByCity} totalByCityWithBaby={totalByCityWithBaby}
                        totalByCityReturnWithParts={totalByCityReturnWithParts} totalByType={totalByType}
                        onlyPartRecuperation={totalOnlyPartRecuperation} carTypeCount={carTypeCount}/>
        </div>
    );
}

export default TrainCapacity
