import {Head} from '@inertiajs/react'
import {PageProps} from '@/types';

export default function Welcome({auth}: PageProps) {
    return (
        <>
            <Head title="Suivi de la capacité des trains"/>
            <h1>Welcome</h1>
        </>
    )
}
