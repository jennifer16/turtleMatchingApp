#!/usr/bin/env python

import shlex, subprocess
import math
import sys
import os.path
import os
from PIL import Image
import numpy as np
import cv2
import histogram as h
import cumulative_histogram as ch
import MySQLdb

def histogram_eq( img ):
	height = img.shape[0]
	width = img.shape[1]
	pixels = width * height

	hist = h.histogram(img)
	cum_hist = ch.cumulative_histogram(hist)

	for i in np.arange(height):
	    for j in np.arange(width):
        	a = img.item(i,j)
	        b = math.floor(cum_hist[a] * 255.0 / pixels)
        	img.itemset((i,j), b)

	return img

def histogram_match( image, refImage ):
	img = cv2.imread(image, cv2.IMREAD_GRAYSCALE)
	img_ref = cv2.imread(refImage, cv2.IMREAD_GRAYSCALE)

	img = histogram_eq(img)	

	height = img.shape[0]
	width = img.shape[1]
	pixels = width * height

	height_ref = img_ref.shape[0]
	width_ref = img_ref.shape[1]
	pixels_ref = width_ref * height_ref

	hist = h.histogram(img)
	hist_ref = h.histogram(img_ref)

	cum_hist = ch.cumulative_histogram(hist)
	cum_hist_ref = ch.cumulative_histogram(hist_ref)

	prob_cum_hist = cum_hist / pixels

	prob_cum_hist_ref = cum_hist_ref / pixels_ref

	K = 256
	new_values = np.zeros((K))

	for a in np.arange(K):
            j = K - 1
	    while True:
		new_values[a] = j
		j = j - 1
		if j < 0 or prob_cum_hist[a] > prob_cum_hist_ref[j]:
			break

	for i in np.arange(height):
	    for j in np.arange(width):
		a = img.item(i,j)
		b = new_values[a]
		img.itemset((i,j), b)

	cv2.imwrite('Input/hist_matched.PNG', img)

#	name of input file
inputName = sys.argv[1]

#	side to matching
side = sys.argv[2]

fileExt = inputName.rpartition(".")[-1]
fileName = inputName.rpartition(".")[-3]

fileInputName = ''

#	if file is jpg or JPG
if ( fileExt == 'jpg'):
	#convert to PNG
	im = Image.open('Input/'+inputName)
	im.save('Input/'+fileName+'.PNG')

elif ( fileExt == 'JPG'):
	#convert to PNG
	im = Image.open('Input/'+inputName)
	im.save('Input/'+fileName+'.PNG')

elif ( fileExt == 'jpeg'):
	#convert to PNG
	im = Image.open('Input/'+inputName)
	im.save('Input/'+fileName+'.PNG')

elif ( fileExt == 'png'):
	#rename to PNG
	im = Image.open('Input/'+inputName)
	im.save('Input/'+fileName+'.PNG')
	
if not os.path.isfile('Input/'+fileName+'.PNG'):
	print 'Cannot find name with '+fileName+'.PNG'
	sys.exit()
else:
	fileInputName='Input/'+fileName+'.PNG'

print 'Doing auto contrast...'

img = cv2.imread(fileInputName, cv2.IMREAD_GRAYSCALE)

height = img.shape[0]
width = img.shape[1]

min = 255
max = 0
for i in np.arange(height):
    for j in np.arange(width):
        a = img.item(i,j)
        if a > max:
            max = a
        if a < min:
            min = a

for i in np.arange(height):
    for j in np.arange(width):
        a = img.item(i,j)
        b = float(a - min) / (max - min) * 255
        img.itemset((i,j), b)

height = img.shape[0]
width = img.shape[1]
pixels = width * height

hist = h.histogram(img)
cum_hist = ch.cumulative_histogram(hist)

for i in np.arange(height):
    for j in np.arange(width):
        a = img.item(i,j)
        b = math.floor(cum_hist[a] * 255.0 / pixels)
        img.itemset((i,j), b)

cv2.imwrite('Input/'+inputName+'.PNG', img)

#	get list of turtle name
connection = MySQLdb.connect( host="127.0.0.1", user="root", passwd="Tu2tlem@tching", db="turtle")
cursor = connection.cursor()
cursor.execute("select * from turtle")
data = cursor.fetchall()
templateFileNameDict = {}
templateFileList = []
for row in data:
	if side == 'LEFT':
		templateFileNameDict[row[0]]=row[2];
	else:
		templateFileNameDict[row[0]]=row[3];
	

#	convert template data to PNG
for key in templateFileNameDict.keys():
	fullname = templateFileNameDict[key]

	fileExt = fullname.rpartition(".")[-1]
	fileName = fullname.rpartition(".")[-3]

	#	if file is jpg or JPG
	if ( fileExt == 'jpg'):
		#convert to PNG
		im = Image.open('Turtle/'+fullname)
		im.save('Turtle/'+fileName+'.PNG')

	elif ( fileExt == 'JPG'):
		#convert to PNG
		im = Image.open('Turtle/'+fullname)
		im.save('Turtle/'+fileName+'.PNG')

	elif ( fileExt == 'jpeg'):
		#convert to PNG
		im = Image.open('Turtle/'+fullname)
		im.save('Turtle/'+fileName+'.PNG')

	elif ( fileExt == 'png'):
		#rename to PNG
		im = Image.open('Turtle/'+fullname)
		im.save('Turtle/'+fileName+'.PNG')

	if not os.path.isfile('Turtle/'+fileName+'.PNG'):
		print 'Cannot find name with '+fileName+'.PNG'
		sys.exit()
	else:
		templateFileList.append('Turtle/'+fileName+'.PNG')
	

#	calculate matching score for left and right template
leftScore=[]
rightScore=[]
for name in templateFileList:
	if side == 'LEFT':
		realNameInput = fileInputName.rpartition(".")[-2]
		realNameTemplate = name.rpartition(".")[-2]
		#	compare with left face
		leftFaceName = name
		outputVName = "./Output/"+realNameInput+"-"+realNameTemplate+"V_LEFT.PNG"
		outputHName = "./Output/"+realNameInput+"-"+realNameTemplate+"H_LEFT.PNG"
		outputMatchingName = "./Output/"+realNameInput+"-"+realNameTemplate+"Mathcing_LEFT.txt"
		outputKeys1Name = "./RawFile/"+realNameTemplate+"Keys_LEFT.txt"
		outputKeys2Name = "./RawFile/"+realNameInput+"HistMatchWith"+realNameTemplate+"Keys.txt"
		
		print 'Doing histogram matching'
		histogram_match( fileInputName, name )

		command_line = "./demo_ASIFT"+" "+leftFaceName+" ./Input/hist_matched.PNG "+outputVName+" "+outputHName+" "+outputMatchingName+" "+outputKeys1Name+" "+outputKeys2Name

		args = shlex.split(command_line)
		p = subprocess.Popen(args)
		p.wait()
		scoreFile = open(outputMatchingName)
		for line in scoreFile:
			score = line.strip()
			score = float(score)
			leftScore.append(score)
			break
	
	if side == 'RIGHT':
		realNameInput = fileInputName.rpartition(".")[-2]
		realNameTemplate = name.rpartition(".")[-2]
		#	compare with left face
		rightFaceName = "Template/Right/"+name+".PNG"
		outputVName = "Output/"+realNameInput+"-"+realNameTemplate+"V_RIGHT.PNG"
		outputHName = "Output/"+realNameInput+"-"+realNameTemplate+"H_RIGHT.PNG"
		outputMatchingName = "Output/"+realNameInput+"-"+name+"Mathcing_RIGHT.txt"
		outputKeys1Name = "./RawFile/"+realNameTemplate+"Keys_RIGHT.txt"
		outputKeys2Name = "./RawFile/"+realNameInput+"HistMatchWith"+realNameTemplate+"Keys.txt"
		
		print 'Doing histogram matching'
		histogram_match( inputFileName, rightFaceName )

		command_line = "./demo_ASIFT"+" "+rightFaceName+" ./Input/hist_matched.PNG "+outputVName+" "+outputHName+" "+outputMatchingName+" "+outputKeys1Name+" "+outputKeys2Name

		args = shlex.split(command_line)
		p = subprocess.Popen(args)
		p.wait()
		scoreFile = open(outputMatchingName)
		for line in scoreFile:
			score = line.strip()
			score = float(score)
			rightScore.append(score)
			break

#	list score and print
for index in range(len(templateFileNameDict.keys())):
	if side == 'LEFT':
		leftPercent = leftScore[index]
		print "$"+ templateFileNameDict[templateFileNameDict.keys()[index]]+","+ str(leftPercent) + ",LEFT"	
	
	if side == 'RIGHT':			
		rightPercent = rightScore[index]
		print "$"+ templateFileNameDict[templateFileNameDict.keys()[index]]+","+ str(rightPercent) + ",RIGHT"
		
	
