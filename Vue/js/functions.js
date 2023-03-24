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
