
var app = new Vue({
	el: "#root",
	data: {
		showingAddModal: false,
		showingEditModal: false,
		showingDeleteModal: false,
		errorMessage: "",
		successMessage: "",
		presensis: [],
		kehadiranDosens: [],
	},

	mounted: function(){
		console.log("mounted");
		 this.presensiFindAllToday();
		 this.kehadiranDosenFindAll();
	},

	methods: {
		presensiFindAllToday: function(){
			axios.get("http://192.168.1.102/smart-presence/api/v1/presensi/find-all-today")
			.then(function(response){
				if(response.data.error){
					app.errorMessage = response.data.message;
				} else{
					console.log(response.data)
					app.presensis = response.data.master;
				}
			});
		},

		kehadiranDosenFindAll: function () {
			axios.get("http://192.168.1.102/smart-presence/api/v1/dosen/kehadiran-dosen-find-all-detail")
				.then(function (response) {
					if (response.data.error){
						app.errorMessage = response.data.message;
					} else {
						console.log(response.data)
						app.kehadiranDosens = response.data.master;
					}

                });
        }
	}
});

var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
    	// logicnya jika ada sinyal dari pusher langsung refresh API perkuliahan hari ini & kehadiran dosen
			app.presensiFindAllToday();
			app.kehadiranDosenFindAll();
      });