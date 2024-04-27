export function trainLoadCalculator(
    neuchatel: number,
    yverdon: number,
    bulle: number,
    nyon: number,
    morges: number,
    lausanne: number,
    montreux: number,
    bienne: number
) {
    const neuchatelBulleMax = 362;
    const nyonBulleMax = 418;
    const bulleRossiniereMax = 972;
    const montreuxRossiniereMax = 200;

    const neuchatelBulle = neuchatel + yverdon + bienne;
    const nyonBulle = nyon + morges + lausanne;
    const montreuxRossiniere = montreux;
    const bulleRossiniere = bulle + neuchatelBulle + nyonBulle;

    return {
        neuchatelBulle,
        neuchatelBulleMax,
        nyonBulle,
        nyonBulleMax,
        montreuxRossiniere,
        montreuxRossiniereMax,
        bulleRossiniere,
        bulleRossiniereMax,
    };
}
