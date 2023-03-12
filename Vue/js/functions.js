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
  var radius = 6378.137; // Earth Radius in KM

  // Haversine formula
  var latitude = (end.x * Math.PI) / 180 - (start.x * Math.PI) / 180;
  var longitude = (end.y * Math.PI) / 180 - (start.y * Math.PI) / 180;
  var d =
    Math.sin(latitude / 2) * Math.sin(latitude / 2) +
    Math.cos((start.x * Math.PI) / 180) *
      Math.cos((end.x * Math.PI) / 180) *
      Math.sin(longitude / 2) *
      Math.sin(longitude / 2);
  var c = 2 * Math.atan2(Math.sqrt(d), Math.sqrt(1 - d));
  var output = radius * c;
  if (meters) {
    output = output * 1000; //Convert to meters
  }
  return output;
}
