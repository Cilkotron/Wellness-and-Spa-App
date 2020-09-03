<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form @submit.prevent>
          <div class="form-group">
            <label for="title">Event Name</label>
            <input type="text" id="title" class="form-control" v-model="newEvent.title">
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="start">Start Date</label>
                <input
                  type="datetime-local"
                  id="start"
                  class="form-control"
                  v-model="newEvent.start"
                >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="end">End Date</label>
                <input type="datetime-local" id="end" class="form-control" v-model="newEvent.end">
              </div>
            </div>
             <div class="col-md-6">
              <div class="form-group">
                <label for="note">Note</label>
                  <textarea class="form-control" name="note" id="note" v-model="newEvent.note"></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="color">Background Color</label>
                <input type="color" id="color" class="form-control" v-model="newEvent.color">
              </div>
            </div>
            <div class="col-md-6 mb-4" v-if="addingMode">
              <button class="btn btn-sm btn-primary" @click="addNewEvent">Save Event</button>
            </div>
            <template v-else>
              <div class="col-md-6 mb-4">
                <button class="btn btn-sm btn-success" @click="updateEvent">Update</button>
                <button class="btn btn-sm btn-danger" @click="deleteEvent">Delete</button>
                <button class="btn btn-sm btn-secondary" @click="addingMode = !addingMode">Cancel</button>
              </div>
            </template>
          </div>
        </form>
      </div>
      <div class="col-md-8">
        <Fullcalendar @eventClick="showEvent" :plugins="calendarPlugins" :events="events"/>
      </div>
    </div>
  </div>
</template>
<script>
import Fullcalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import axios from "axios";
export default {
  components: {
    Fullcalendar
  },
  data() {
    return {
      calendarPlugins: [dayGridPlugin, interactionPlugin],
      events: "",
      newEvent: {
        title: "",
        start: "",
        end: "",
        note: "",
        color: ""
      },
      addingMode: true,
      indexToUpdate: ""
    };
  },
  created() {
    this.getEvents();
  },
  methods: {
    addNewEvent() {
      axios
        .post("/api/admin/event/", {
          ...this.newEvent
        })
        .then(data => {
          this.getEvents(); // update our list of events
          this.resetForm(); // clear newEvent properties (e.g. title, start_date and end_date)
        })
        .catch(err =>
          console.log("Unable to add new event!", err.response.data)
        );
    },
    showEvent(arg) {
      this.addingMode = false;
      const { id, title, start, end } = this.events.find(
        event => event.id === +arg.event.id
      );
      this.indexToUpdate = id;
      this.newEvent = {
        title: title,
        start: start,
        end: end,
        note: note,
        color:color
      };
    },
    updateEvent() {
      axios
        .put("/api/admin/event/" + this.indexToUpdate, {
          ...this.newEvent
        })
        .then(resp => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );
    },
    deleteEvent() {
      axios
        .delete("/api/admin/event/" + this.indexToUpdate)
        .then(resp => {
          this.resetForm();
          this.getEvents();
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to delete event!", err.response.data)
        );
    },
    getEvents() {
      axios
        .get("/api/admin/event/")
        .then(resp => (this.events = resp.data.data))
        .catch(err => console.log(err.response.data));
    },
    resetForm() {
      Object.keys(this.newEvent).forEach(key => {
        return (this.newEvent[key] = "");
      });
    }
  },
  watch: {
    indexToUpdate() {
      return this.indexToUpdate;
    }
  }
};
</script>


