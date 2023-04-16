/**
 *  Title:          Functions
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

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

  // Extract latitudes and longitudes
  const { x: lat1, y: lon1 } = start;
  const { x: lat2, y: lon2 } = end;

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
  if (meters) {
    output *= 1000; //Convert to meters
  }
  return output;
}

/**
 *
 * Algorithm to find the closest node to the specified location on the map
 *
 * @param {array} locations - To Search Through
 * @param {int} x - latitude
 * @param {int} y - longitude
 * @param {int} z - altitude
 * @returns
 */
export function getClosestNode(locations = null, x = 0, y = 0, z = 0) {
  if (locations === null || locations.length === 0) {
    return null;
  }

  let closestDistance = Infinity;
  let closestNode = null;

  for (let i = 0; i < locations.length; i++) {
    const location = locations[i];

    const distance = Math.sqrt(
      Math.pow(location.mapLongitude - x, 2) +
        Math.pow(location.mapLatitude - y, 2) +
        Math.pow(location.mapAltitude - z, 2)
    );

    if (distance < closestDistance) {
      closestDistance = distance;
      closestNode = location;
    }
  }
  return closestNode;
}
