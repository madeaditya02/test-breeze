<template>
  <div :class="class">
    <div ref="mapRef" id="map" style="width: 100%; height: 300px"></div>
  </div>
</template>

<script>
import { ref, onMounted, defineProps } from 'vue';
import { Loader } from '@googlemaps/js-api-loader';

export default {
  props: ['class'],
  setup() {
    // defineProps(['class']);
    const mapRef = ref(null);

    const initMap = async () => {
      const loader = new Loader({
        apiKey: import.meta.env.VITE_MAPS_API_KEY,
        // libraries: ['maps'],
      });

      // const google = await loader.load();
      // const { Map } = await google.maps.importLibrary("maps");
      // const map = new google.maps.Map(mapRef.value, {
      //   center: { lat: -34.397, lng: 150.644 },
      //   zoom: 10,
      // });
      const { Map } = await loader.importLibrary('maps');
      const { UnitSystem } = await loader.importLibrary('core');
      // console.log(r);
      const { DirectionsService, DirectionsRenderer, DirectionsStatus, TravelMode, DistanceMatrixService } = await loader.importLibrary('routes');
      const map = new Map(mapRef.value, {
        center: { lat: -8.798341207789955, lng: 115.17244958977128 },
        zoom: 16,
      });
      const directionsService = new DirectionsService();
      const directionsRenderer = new DirectionsRenderer();
      directionsRenderer.setMap(map);
      const request = {
        origin: { lat: -8.798341207789955, lng: 115.17244958977128 },
        destination: { lat: -8.793044924533483, lng: 115.17156168709445 },
        waypoints: [
          {
            location: { lat: -8.79930323535656, lng: 115.17067510356566 },
            stopover: true,
          },
        ],
        travelMode: TravelMode.DRIVING,
      };

      directionsService.route(request, (result, status) => {
        if (status === DirectionsStatus.OK) {
          directionsRenderer.setDirections(result);
        } else {
          console.error('Directions request failed due to ' + status);
        }
      });

      const service = new DistanceMatrixService();
      // build request
      const origin1 = { lat: 55.93, lng: -3.118 };
      const origin2 = "Greenwich, England";
      const destinationA = "Stockholm, Sweden";
      const destinationB = { lat: 50.087, lng: 14.421 };
      const requestDistance = {
        origins: [{ lat: -8.798341207789955, lng: 115.17244958977128 }],
        destinations: [{ lat: -8.793044924533483, lng: 115.17156168709445 }],
        travelMode: TravelMode.DRIVING,
        unitSystem: UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false,
      };
      service.getDistanceMatrix(requestDistance).then((response) => {
        // console.log(response);
      });
    };

    onMounted(() => {
      initMap();
    });

    return {
      mapRef,
    };
  },
};
</script>

<style>
#map {
  width: 100%;
  height: 500px;
}
</style>
