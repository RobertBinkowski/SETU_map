/**
 *  Title:          A Star
 *  by:             Robert Binkowski
 *  Student No:     C00237917
 */

/**
 *
 * Heuristic function to calculate the heuristic value between 2 points
 *
 * @param {int} start - start Node
 * @param {int} end - end Node
 * @returns combined difference between 2 points
 */
function heuristic(start, end) {
    //Calculate the distance between 2 points X-value and Y-value
    let d1 = Math.abs(start.x - end.x);
    let d2 = Math.abs(start.y - end.y);
    let d3 = Math.abs(start.z - end.z);
  
    //Return the outcome which is a heuristic value
    return d1 + d2 + d3;
  }


function reconstruct_path(cameFrom, current)
    const path = []

    let currentKey = `${tRow}x${tCol}`
    let current = cells[tRow][tCol]

    while (current !== start){
        path.push(current)
        const {key, cell} = parentForCell[currentKey] 
        current = cell
        currentKey = key
    }
    return total_path

// A* finds a path from start to goal.
// h is the heuristic function. h(n) estimates the cost to reach goal from node n.
function A_Star(start, goal, h)
    // The set of discovered nodes that may need to be (re-)expanded.
    // Initially, only the start node is known.
    // This is usually implemented as a min-heap or priority queue rather than a hash-set.
    openSet := {start}

    // For node n, cameFrom[n] is the node immediately preceding it on the cheapest path from start
    // to n currently known.
    cameFrom := an empty map

    // For node n, gScore[n] is the cost of the cheapest path from start to n currently known.
    gScore := map with default value of Infinity
    gScore[start] := 0

    // For node n, fScore[n] := gScore[n] + h(n). fScore[n] represents our current best guess as to
    // how cheap a path could be from start to finish if it goes through n.
    fScore := map with default value of Infinity
    fScore[start] := h(start)

    while (openSet > 0){
        // This operation can occur in O(Log(N)) time if openSet is a min-heap or a priority queue
        current := the node in openSet having the lowest fScore[] value
        if (current == goal){
            return reconstruct_path(cameFrom, current);
        }
        openSet.Remove(current)
        foreach ( neighbor as current){
            // d(current,neighbor) is the weight of the edge from current to neighbor
            // tentative_gScore is the distance from start to the neighbor through current
            tentative_gScore := gScore[current] + d(current, neighbor)
            if tentative_gScore < gScore[neighbor]
                // This path to neighbor is better than any previous one. Record it!
                cameFrom[neighbor] := current
                gScore[neighbor] := tentative_gScore
                fScore[neighbor] := tentative_gScore + h(neighbor)
                if neighbor not in openSet
                    openSet.add(neighbor)
        }
    }
    // Open set is empty but goal was never reached
    return failure