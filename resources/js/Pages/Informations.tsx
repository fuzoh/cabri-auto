const Informations = ({
    registrations,
    validated,
    expected_amount,
    received_amount
                      }) => {
    return (
        <div>
            <h1>Informations</h1>
            <p>Nombre d'inscriptions: {registrations}</p>
            <p>Nombre qui ont payé: {validated}</p>
            <p>Somme totale attendue: {expected_amount}</p>
            <p>Somme actuellement payée: {received_amount}</p>
        </div>
    );
}

export default Informations
