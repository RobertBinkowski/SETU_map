/**
 *  Title:          Functions
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

import { Node } from "./node.js";

/**
 * Calculate Geological Distance in Meters
 *
 * @param {Node} start - Departure Node
 * @param {Node} end - Destination Node
 * @param {Boolean} meters - change to meters
 * @returns Geographical distance between 2 points
 */
export function geoDistance(start, end, meters = false) {
  const radius = 6378.137; // Earth Radius in KM
  const metersDistance = 1000;
  if (start.coordinates === null || end.coordinates === null) {
    return null;
  }
  // Extract latitudes and longitudes
  const {
    coordinates: { latitude: lat1, longitude: lon1 },
  } = start;
  const {
    coordinates: { latitude: lat2, longitude: lon2 },
  } = end;

  // Haversine formula
  const latitude = (lat2 * Math.PI) / 180 - (lat1 * Math.PI) / 180;
  const longitude = (lon2 * Math.PI) / 180 - (lon1 * Math.PI) / 180;
  const d =
    Math.sin(latitude / 2) ** 2 +
    Math.cos((lat1 * Math.PI) / 180) *
      Math.cos((lat2 * Math.PI) / 180) *
      Math.sin(longitude / 2) ** 2;

  const c = 2 * Math.atan2(Math.sqrt(d), Math.sqrt(1 - d));
  var output = radius * c;

  // Convert to meters
  if (meters) {
    output *= metersDistance;
  }

  return output;
}

/**
 *
 * Algorithm to find the closest node to the specified location on the map
 *
 * @param {array} locations - To Search Through
 * @param {int} longitude - latitude
 * @param {int} latitude - longitude
 * @param {int} altitude - altitude
 * @returns
 */
export function getClosestNode(
  locations = null,
  longitude = 0,
  latitude = 0,
  altitude = 0
) {
  if (locations === null || locations.length === 0) {
    return null;
  }
  let closestDistance = Infinity;
  let closestNode = null;
  let distance = 0;
  const loc = new Node(0, longitude, latitude, altitude);

  for (let i = 0; i < locations.length; i++) {
    const location = locations[i];

    distance = geoDistance(location, loc);
    if (distance < closestDistance) {
      closestDistance = distance;
      closestNode = location;
    }
  }
  return closestNode;
}
