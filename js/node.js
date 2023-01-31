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
   * @param {str} acronym - Acronym of the location
   * @param {str} type - Type of the location [room, bathroom] - Pulled from database
   * @param {int} floor - floor
   * @param {double} geo_longitude - Longitude Geo Location
   * @param {double} geo_latitude - Latitude Geo Location
   *
   */
  constructor(
    name,
    priority,
    x,
    y,
    z = 0,
    info = "",
    acronym = "",
    type = "",
    floor = 0,
    geo_longitude = null,
    geo_latitude = null
  ) {
    this.name = name;
    this.priority = priority;

    //Location Information
    this.info = info;
    this.acronym = acronym;
    this.type = type;
    this.floor = floor;

    //Location Info
    this.x = x;
    this.y = y;
    this.z = z;

    this.f = 0; //Total Cost Function
    this.g = 0; //cost from start to the current point
    this.h = 0; //heuristic estimate from current end

    this.neighbors = []; // neighbors of the current point
    this.parent = undefined; // source of the current point

    this.geo_longitude = geo_longitude;
    this.geo_latitude = geo_latitude;
  }
}
