import axios from "axios";
export default class Request{
    static async getEvent(id){
        var event = await (await axios.get("http://localhost:8000/event/" + id)).data.event
        return event
    }
    static async getEvents(){
        var events = await (await axios.get("http://localhost:8000/event")).data.events
        return events
    }
    postEvent(){

    }
    putEvent(id){

    }
    static async deleteEvent(id){
        var config = {
            method: 'delete',
            url: 'http://localhost:8000/event/' + id,
            headers: { }
          };
        var event = await axios(config)
        return event
    }
}