/**
 *  Title:          Priority Queue
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

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
 * @param {bool} blocked - Set weather it is accusable
 *
 */
export function Node(
  name,
  x,
  y,
  z = 0,
  info = "",
  acronym = "",
  type = "",
  floor = 0,
  geo_longitude = null,
  geo_latitude = null,
  blocked = false
) {
  this.name = name;

  //Location Information
  this.info = info;
  this.acronym = acronym;
  this.type = type;
  this.floor = floor;

  //Location Info
  this.x = x;
  this.y = y;
  this.z = z;
  this.blocked = blocked;

  this.f = 0; //Total Cost Function
  this.g = 0; //From the start
  this.h = 0; //heuristic

  this.neighbors = []; // neighbors of the current point
  this.parent = undefined; // source of the current point

  this.geo_longitude = geo_longitude;
  this.geo_latitude = geo_latitude;

  // update neighbors array for a given grid point
  this.updateNeighbors = function (grid, row, column) {
    let i = this.x;
    let j = this.y;
    if (i < column - 1) {
      this.neighbors.push(grid[i + 1][j]);
    }
    if (i > 0) {
      this.neighbors.push(grid[i - 1][j]);
    }
    if (j < row - 1) {
      this.neighbors.push(grid[i][j + 1]);
    }
    if (j > 0) {
      this.neighbors.push(grid[i][j - 1]);
    }
  };
}
