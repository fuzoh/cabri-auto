import { Handle, NodeProps, Position } from 'reactflow';

export type NodeData = {
  label: string;
  total: number;
};

function StationNode({ id, data }: NodeProps<NodeData>) {
  return (
    <>
        <div className="p-2 m-2 border border-red-400 rounded-md text-center">
            <p>{data.label}</p>
            <p><span className="font-medium">allé {data.total}</span> pers.</p>
            <p><span className="font-medium">retour {data.totalRetour}</span> pers.</p>
        </div>

        <Handle type="target" position={Position.Left}/>
        <Handle type="source" position={Position.Right} />
    </>
  );
}

export default StationNode;
