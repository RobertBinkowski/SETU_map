/**
 *  Title:          Priority Queue
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

/**
 *      Node element of the Queue
 */
export class Node {
  /**
   *
   * @param {str} name - Name of the location
   * @param {int} priority - priority
   * @param {double} x - X Coordinates
   * @param {double} y - Y Coordinates
   * @param {double} z - Z Coordinates
   * @param {str} info - Location Information
   * @param {double} geo_longitude - Longitude Geo Location
   * @param {double} geo_latitude - Latitude Geo Location
   */
  constructor(
    name,
    priority,
    x,
    y,
    z = 0,
    info = "",
    geo_longitude = null,
    geo_latitude = null
  ) {
    this.name = name;
    this.priority = priority;
    this.info = info;

    this.x = x;
    this.y = y;
    this.z = z;

    this.f = 0; //total cost function
    this.g = 0; //cost function from start to the current grid point
    this.h = 0; //heuristic estimated cost function from current grid point to the goal

    this.neighbors = []; // neighbors of the current grid point
    this.parent = undefined; // source of the current grid point

    this.geo_longitude = geo_longitude;
    this.geo_latitude = geo_latitude;
  }
}
