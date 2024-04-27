import {PageProps} from "@/types";
import GenericLayout from "@/Layouts/GenericLayout";
import TrainGraph from "@/Components/TrainGraph";

const TrainCapacity = ({ auth } : PageProps) => {
    return (
        <div className="h-full">
            <TrainGraph />
        </div>
    );
}

export default TrainCapacity
