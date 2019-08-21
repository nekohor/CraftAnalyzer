const coilUtils = {
    getCoilOptions:(coilIds) => {
        let options = coilIds.map( coilId => {
            return {
                value: coilId,
                label: coilId
            }
        })
        return options
    }
}






export default coilUtils
