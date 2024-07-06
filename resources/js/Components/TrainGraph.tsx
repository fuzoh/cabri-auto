import React from 'react';
import ReactFlow, {Background, Controls, MiniMap, Panel} from 'reactflow';

import 'reactflow/dist/style.css';
import StationNode from "@/Components/StationNode";
import {trainLoadCalculator} from "@/services/trainLoadCalculator";
import NoHandleNode from "@/Components/NoHandleNode";

const nodeTypes = {
    station: StationNode,
    other: NoHandleNode,
}

export default function TrainGraph({
                                       totalByCity,
                                       totalByCityWithBaby,
                                       totalByCityReturnWithParts,
                                       totalByType,
                                       onlyPartRecuperation,
                                       carTypeCount
                                   }) {

    let loads = trainLoadCalculator(
        totalByCityWithBaby.Neuchatel ?? 0,
        totalByCityWithBaby.Yverdon ?? 0,
        totalByCityWithBaby.Bulle ?? 0,
        totalByCityWithBaby.Nyon ?? 0,
        totalByCityWithBaby.Morges ?? 0,
        totalByCityWithBaby.Lausanne ?? 0,
        totalByCityWithBaby.Montreux ?? 0,
        totalByCityWithBaby.Bienne ?? 0
    )

    let loadsRetour = trainLoadCalculator(
        totalByCityReturnWithParts.Neuchatel ?? 0,
        totalByCityReturnWithParts.Yverdon ?? 0,
        totalByCityReturnWithParts.Bulle ?? 0,
        totalByCityReturnWithParts.Nyon ?? 0,
        totalByCityReturnWithParts.Morges ?? 0,
        totalByCityReturnWithParts.Lausanne ?? 0,
        totalByCityReturnWithParts.Montreux ?? 0,
        totalByCityReturnWithParts.Bienne ?? 0
    )

    let total = loads.bulleRossiniere + loads.montreuxRossiniere
    let totalRetour = loadsRetour.bulleRossiniere + loadsRetour.montreuxRossiniere

    let grandTotal = total + totalByType.car + totalByType.autonomous + totalByType.local_resident

    const initialNodes = [
        {
            id: '1',
            position: {x: 200, y: 50},
            data: {label: 'Neuchâtel', total: totalByCityWithBaby.Neuchatel ?? 0, totalRetour: totalByCityReturnWithParts.Neuchatel ?? 0},
            type: 'station'
        },
        {
            id: '2',
            position: {x: 400, y: 50},
            data: {label: 'Yverdon', total: totalByCityWithBaby.Yverdon ?? 0, totalRetour: totalByCityReturnWithParts.Yverdon ?? 0},
            type: 'station'
        },
        {id: '3', position: {x: 600, y: 100}, data: {label: 'Bulle', total: totalByCityWithBaby.Bulle ?? 0, totalRetour: totalByCityReturnWithParts.Bulle ?? 0}, type: 'station'},
        {id: '4', position: {x: 800, y: 100}, data: {label: 'Rossinière', total, totalRetour}, type: 'station'},
        {id: '5', position: {x: 0, y: 150}, data: {label: 'Nyon', total: totalByCityWithBaby.Nyon ?? 0, totalRetour: totalByCityReturnWithParts.Nyon ?? 0}, type: 'station'},
        {id: '6', position: {x: 200, y: 150}, data: {label: 'Morges', total: totalByCityWithBaby.Morges ?? 0, totalRetour: totalByCityReturnWithParts.Morges ?? 0}, type: 'station'},
        {
            id: '7',
            position: {x: 400, y: 150},
            data: {label: 'Lausanne', total: totalByCityWithBaby.Lausanne ?? 0, totalRetour: totalByCityReturnWithParts.Lausanne ?? 0},
            type: 'station'
        },
        {
            id: '8',
            position: {x: 600, y: 200},
            data: {label: 'Montreux', total: totalByCityWithBaby.Montreux ?? 0, totalRetour: totalByCityReturnWithParts.Montreux ?? 0},
            type: 'station'
        },
        {id: '9', position: {x: 0, y: 0}, data: {label: 'Bienne', total: totalByCityWithBaby.Bienne ?? 0, totalRetour: totalByCityReturnWithParts.Bienne ?? 0}, type: 'station'},
        {
            id: '10',
            position: {x: 270, y: -50},
            data: {label: `${carTypeCount} voitures`, total: totalByType.car},
            type: 'other'
        },
        {id: '11', position: {x: 400, y: -50}, data: {label: 'AG', total: totalByType.autonomous}, type: 'other'},
        {
            id: '12',
            position: {x: 500, y: -50},
            data: {label: 'Region', total: totalByType.local_resident},
            type: 'other'
        },
        {id: '13', position: {x: 600, y: -50}, data: {label: 'TOTAL', total: grandTotal}, type: 'other'},
        {
            id: '14',
            position: {x: 700, y: -50},
            data: {label: 'Part. Récupération', total: onlyPartRecuperation},
            type: 'other'
        },
    ];
    const initialEdges = [
        {
            id: 'e1-2',
            source: '1',
            target: '2',
            animated: true,
            label: `${loadsRetour.neuchatelBulle} / ${loadsRetour.neuchatelBulleMax}`
        },
        {
            id: 'e2-3',
            source: '2',
            target: '3',
            animated: true,
            label: `${loadsRetour.neuchatelBulle} / ${loadsRetour.neuchatelBulleMax}`
        },
        {
            id: 'e3-4',
            source: '3',
            target: '4',
            animated: true,
            label: `${loadsRetour.bulleRossiniere} / ${loadsRetour.bulleRossiniereMax}`
        },
        {id: 'e5-6', source: '5', target: '6', animated: true, label: `${loadsRetour.nyonBulle} / ${loadsRetour.nyonBulleMax}`},
        {id: 'e6-7', source: '6', target: '7', animated: true, label: `${loadsRetour.nyonBulle} / ${loadsRetour.nyonBulleMax}`},
        {id: 'e7-3', source: '7', target: '3', animated: true, label: `${loadsRetour.nyonBulle} / ${loadsRetour.nyonBulleMax}`},
        {
            id: 'e8-4',
            source: '8',
            target: '4',
            animated: true,
            label: `${loadsRetour.montreuxRossiniere} / ${loadsRetour.montreuxRossiniereMax}`
        },
        //{ id: 'e9-3', source: '9', target: '4', animated: true },
        {id: 'e9-1', source: '9', target: '1', animated: true},

    ];

    return (
        <div style={{width: '100%', height: '100vh'}}>
            <ReactFlow
                nodes={initialNodes}
                edges={initialEdges}
                nodeTypes={nodeTypes}
                fitView
            >
                <Panel position="top-left">Capacité restante des trains</Panel>
                <Controls/>
                <MiniMap/>
                <Background variant="dots" gap={12} size={1}/>
            </ReactFlow>
        </div>
    );
}
