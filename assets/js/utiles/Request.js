import axios from "axios";
const URL_EVENT = "http://localhost:8000/event"

export default class Request {
    static async getEvent(id) {
        var event = await (await axios.get(URL_EVENT + "/" + id)).data.event
        return event
    }
    static async getEvents() {
        var events = await (await axios.get(URL_EVENT)).data.events
        return events
    }
    static async postEvent(event, onThen, onCatch) {
        try {
            var data = new FormData();
            data.append("image", event.file[0]);
            data.append("title", event.title);
            data.append("organizer", event.organizer);
            data.append("type", event.type);
            data.append("locality", event.locality);
            data.append("date", event.date);
            data.append("image", event.file[0].name);

            axios.post(URL_EVENT, data)
                .then((res) => {
                    onThen(res)
                })
                .catch((err) => {
                    onCatch(err)
                })
        } catch (error) {
            console.log(error);
        }
    }
    static async putEvent(event, onThen, onCatch) {
        try {
            var data = new FormData()
            if (event.title) {
                data.append("title", event.title);
            }
            if (event.organizer) {
                data.append("organizer", event.organizer);
            }
            if (event.type) {
                data.append("type", event.type);
            }
            if (event.locality) {
                data.append("locality", event.locality);
            }
            if (event.data) {
                data.append("date", event.date);
            }
            if (event.file !== null) {
                data.append("file", event.file[0]);
                data.append("image", event.file[0].name);
            }
            axios.post(URL_EVENT + "/" + event.id, data)
                .then((res) => {
                    onThen(res)
                })
                .catch((err) => {
                    onCatch(err)
                });

        } catch (error) {
            console.log(error);
        }
    }
    static async deleteEvent(id) {
        var config = {
            method: 'delete',
            url: URL_EVENT + "/" + id,
            headers: {}
        };
        var event = await axios(config)
        return event
    }
}