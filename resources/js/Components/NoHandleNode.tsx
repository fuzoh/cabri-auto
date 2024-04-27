import { Handle, NodeProps, Position } from 'reactflow';

export type NodeData = {
  label: string;
  total: number;
};

function NoHandleNode({ id, data }: NodeProps<NodeData>) {
  return (
    <>
        <div className="p-2 m-2 border border-red-400 rounded-md text-center">
            <p>{data.label}</p>
            <p><span className="font-medium">{data.total}</span> pers.</p>
        </div>
    </>
  );
}

export default NoHandleNode;
