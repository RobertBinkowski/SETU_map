/**
 *  Title:          Functions
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

/**
 *
 * Heuristic function to calculate the heuristic value between 2 points
 *
 * @param {Node} start - Departure Node
 * @param {Node} end - Destination Node
 * @returns combined difference between 2 points
 */
export function mapDistance(start, end) {
  //  Calculate the distance between 2 nodes
  //  Ensure all values are positive
  let d1 = pos(pos(start.x) - pos(end.x));
  let d2 = pos(pos(start.y) - pos(end.y));
  let d3 = pos(pos(start.z) - pos(end.z));

  //  Return the outcome which is a heuristic value
  return d1 + d2 + d3;
}

/**
 * Calculate Geological Distance in Meters
 *
 * @param {Node} start - Departure Node
 * @param {Node} end - Destination Node
 * @returns Geographical distance between 2 points
 */
export function geoDistance(start, end) {
  var radius = 6378.137; // Earth Radius in KM

  // Haversine formula
  var latitude =
    (end.geo_latitude * Math.PI) / 180 - (start.geo_latitude * Math.PI) / 180;
  var longitude =
    (end.geo_longitude * Math.PI) / 180 - (start.geo_longitude * Math.PI) / 180;
  var d =
    Math.sin(latitude / 2) * Math.sin(latitude / 2) +
    Math.cos((start.geo_latitude * Math.PI) / 180) *
      Math.cos((end.geo_latitude * Math.PI) / 180) *
      Math.sin(longitude / 2) *
      Math.sin(longitude / 2);
  var c = 2 * Math.atan2(Math.sqrt(d), Math.sqrt(1 - d));
  var output = radius * c;
  output = output * 1000; //Convert to meters
  return output;
}

/**
 * Turn Value To Positive
 *
 * @param {double} input - Int/Double
 * @returns Return a positive Value
 */
function pos(input) {
  return Math.abs(input);
}
