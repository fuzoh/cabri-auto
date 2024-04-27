import React from 'react';
import ReactFlow, {Background, Controls, MiniMap, Panel} from 'reactflow';

import 'reactflow/dist/style.css';
import StationNode from "@/Components/StationNode";
import {trainLoadCalculator} from "@/services/trainLoadCalculator";

const nodeTypes = {
    station: StationNode,
}

const initialNodes = [
  { id: '1', position: { x: 200, y: 50 }, data: { label: 'Neuchâtel' }, type: 'station' },
  { id: '2', position: { x: 400, y: 50 }, data: { label: 'Yverdon' }, type: 'station' },
  { id: '3', position: { x: 600, y: 100 }, data: { label: 'Bulle' }, type: 'station' },
  { id: '4', position: { x: 800, y: 100 }, data: { label: 'Rossignère' }, type: 'station' },
  { id: '5', position: { x: 0, y: 150 }, data: { label: 'Nyon' }, type: 'station' },
  { id: '6', position: { x: 200, y: 150 }, data: { label: 'Morges' }, type: 'station' },
  { id: '7', position: { x: 400, y: 150 }, data: { label: 'Lausanne' }, type: 'station' },
  { id: '8', position: { x: 600, y: 200 }, data: { label: 'Montreux' }, type: 'station' },
  { id: '9', position: { x: 0, y: 0 }, data: { label: 'Bienne' }, type: 'station' },
];
const initialEdges = [
    { id: 'e1-2', source: '1', target: '2', animated: true, label: '200/360' },
    { id: 'e2-3', source: '2', target: '3', animated: true },
    { id: 'e3-4', source: '3', target: '4', animated: true },
    { id: 'e5-6', source: '5', target: '6', animated: true },
    { id: 'e6-7', source: '6', target: '7', animated: true },
    { id: 'e7-3', source: '7', target: '3', animated: true },
    { id: 'e8-4', source: '8', target: '4', animated: true },
    //{ id: 'e9-3', source: '9', target: '4', animated: true },
    { id: 'e9-1', source: '9', target: '1', animated: true },

];

export default function TrainGraph({ totalByCity, totalByCityWithBaby }) {
    console.log(totalByCity)
    let loads = trainLoadCalculator(
        totalByCity.Neuchatel ?? 0,
        totalByCity.Yverdon ?? 0,
        totalByCity.Bulle ?? 0,
        totalByCity.Nyon ?? 0,
        totalByCity.Morges ?? 0,
        totalByCity.Lausanne ?? 0,
        totalByCity.Montreux ?? 0,
        totalByCity.Bienne ?? 0
    )

    console.log(loads);

    return (
    <div style={{ width: '100%', height: '600px' }}>
      <ReactFlow
          nodes={initialNodes}
          edges={initialEdges}
          nodeTypes={nodeTypes}
          fitView
      >
          <Panel position="top-left">Capacité restante des trains</Panel>
        <Controls />
        <MiniMap />
          <Background variant="dots" gap={12} size={1} />
      </ReactFlow>
    </div>
  );
}
