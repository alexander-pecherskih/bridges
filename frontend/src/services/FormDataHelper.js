export default class FormDataHelper {
  static createFromObject(object) {
    const formData = new FormData()

    for (const key in object) {
      if (Object.prototype.hasOwnProperty.call(object, key)) {
        formData.append(key, object[key])
      }
    }

    return formData
  }
}
