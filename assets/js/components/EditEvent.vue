<script>
import "../../styles/AddEvent.css"
import axios from "axios";


export default {
    data() {
        var event = this.event
        event.file = null
        return {
            event: event
        };
    },
    methods: {
        EditEvent() {
            try {
                const onThen = (response) => {
                    this.event = response.data[0]
                }
                const onCatch = (err) => {
                    console.log(err);
                }
                var data = new FormData()
                data.append("title", this.event.title);
                data.append("organizer", this.event.organizer);
                data.append("type", this.event.type);
                data.append("locality", this.event.locality);
                data.append("date", this.event.date);
                data.append("image", this.event.image);
                if(this.event.file !== null){
                    data.append("file", this.event.file[0]);
                }
                axios.post("http://localhost:8000/event/" + this.event.id, data)
                    .then(onThen)
                    .catch(onCatch);

            } catch (error) {
                console.log(error);
            }
        }
    },
    components: {},
    props: {
        event: Object,
    }
}
</script>
    
<template>
    <div class="modal fade" :id="'Modal-edit-' + event.id" tabindex="-1" :aria-labelledby="'Modal-edit-' + event.id"
        aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit event {{  event.title  }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="InputTitle">Title</label>
                            <input :value="event.title" @input="e => event.title = e.target.value" type="text"
                                class="form-control" id="InputTitle" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label for="InputOrganizer">Organizer</label>
                            <input :value="event.organizer" @input="e => event.organizer = e.target.value" type="text"
                                class="form-control" id="InputOrganizer" placeholder="Organizer">
                        </div>
                        <div class="form-group">
                            <label for="InputType">Type</label>
                            <input :value="event.type" @input="e => event.type = e.target.value" type="text"
                                class="form-control" id="InputType" placeholder="Type">
                        </div>
                        <div class="form-group">
                            <label for="formFile" class="form-label">image</label>
                            <div>
                                <img :src="'http://localhost:8000/uploads/images/events/' + event.image">
                                <input @input="e => event.file = e.target.files" class="form-control" type="file"
                                    id="formFile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="InputDate">Date</label>
                            <input :value="event.date" @input="e => event.date = e.target.value" type="text"
                                class="form-control" id="InputDate" placeholder="2022-12-20">
                        </div>
                        <div class="form-group">
                            <label for="InputLocality">Locality</label>
                            <input :value="event.locality" @input="e => event.locality = e.target.value" type="text"
                                class="form-control" id="InputLocality" placeholder="Paris">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button @click="EditEvent" type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>