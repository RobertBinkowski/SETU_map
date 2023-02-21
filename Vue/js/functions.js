/**
 *  Title:          Functions
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

/**
 *
 * Heuristic function to calculate the heuristic value between 2 points
 *
 * @param {Node} start - start Node
 * @param {Node} end - end Node
 * @returns combined difference between 2 points
 */
export function calculateDistance(start, end) {
  //  Calculate the distance between 2 nodes
  //  Ensure all values are positive
  let d1 = pos(pos(start.x) - pos(end.x));
  let d2 = pos(pos(start.y) - pos(end.y));
  let d3 = pos(pos(start.z) - pos(end.z));

  //  Return the outcome which is a heuristic value
  return Math.abs(d1 + d2 + d3);
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
