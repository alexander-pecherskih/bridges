export default class FormDataHelper {
    static createFromObject(object) {
        const formData = new FormData()

        for (let key in object) {
            if (object.hasOwnProperty(key)) {
                formData.append(key, object[key])
            }
        }

        return formData
    }
}