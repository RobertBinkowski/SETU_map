/**
 *
 * Heuristic function to calculate the heuristic value between 2 points
 *
 * @param {Node} start - start Node
 * @param {Node} end - end Node
 * @returns combined difference between 2 points
 */
function calculateHeuristic(start, end) {
  //Calculate the distance between 2 nodes
  let d1 = Math.abs(start.x - end.x);
  let d2 = Math.abs(start.y - end.y);
  let d3 = Math.abs(start.z - end.z);

  //Return the outcome which is a heuristic value
  return Math.abs(d1 + d2 + d3);
}
