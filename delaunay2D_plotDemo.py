#!/usr/bin/env python3
# -*- coding: ascii -*-

import sys
import numpy as np 
from delaunay2D import Delaunay2D

import matplotlib
import matplotlib.pyplot as plt
import matplotlib.tri
import matplotlib.collections

if __name__ == '__main__':

    print ('starting....')

    fileName = sys.argv[3]

    listX = sys.argv[1]
    listX = listX.strip()
    listX = listX.split(' ')

    listY = sys.argv[2]
    listY = listY.strip()
    listY = listY.split(' ')

    seeds = []

    for i in range(len(listX)):
        seeds.append( (float(listX[i]), float(listY[i])  ) )

    radius = 100
    seeds.sort(key=lambda x: [x[0],x[1]])
    print("seeds:", seeds)
    print("BBox Min:", np.amin(seeds, axis=0), "Bbox Max: ", np.amax(seeds, axis=0))

    center = np.mean(seeds, axis=0)
    dt = Delaunay2D(center, 50 * radius)

    for s in seeds:
        dt.addPoint(s)

    print (len(dt.exportTriangles()), "Delaunay triangles")

    fig, ax = plt.subplots()
    ax.margins(0.1)
    ax.set_aspect('equal')
    plt.style.use('dark_background')
    plt.axis([-1, radius+1, -1, radius+1])
    plt.axis('off')
    plt.autoscale(True)

    print('setting axis')

    cx, cy = zip(*seeds)
    dt_tris = dt.exportTriangles()

    ax.triplot(matplotlib.tri.Triangulation(cx, cy, dt_tris), 'wo-')

    print(cx)
    print(cy)
    print(dt_tris)
    plt.savefig('./Turtle/'+fileName+'.jpg', dpi=96)
    print('save at ./Turtle/'+fileName+'.jpg')