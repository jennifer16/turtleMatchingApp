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

def histogram_match( inputName, templateName):
	img = cv2.imread(inputName, cv2.IMREAD_GRAYSCALE)
	img_ref = cv2.imread(templateName, cv2.IMREAD_GRAYSCALE)

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

	cv2.imwrite('./Input/hist_matched.PNG', img)


#   input name
inputName = sys.argv[1]
#	side to matching
side = sys.argv[2]

fileExt = inputName.rpartition(".")[-1]
fileName = inputName.rpartition(".")[-3]
useThisFileName = fileName;

fileInputName = ''

#	if file is jpg or JPG
if not os.path.isfile('Input/'+fileName+'.PNG'):
	im = Image.open('Input/'+inputName)
	im.save('Input/'+fileName+'.PNG')
	
if not os.path.isfile('Input/'+fileName+'.PNG'):
	print 'Cannot find name with '+fileName+'.PNG'
	sys.exit()
else:
	fileInputName='Input/'+fileName+'.PNG'

#	get list of turtle name
connection = MySQLdb.connect( host="127.0.0.1", user="root", passwd="Tu2tlem@tching", db="turtle")
cursor = connection.cursor()
cursor.execute("select * from turtle")
data = cursor.fetchall()
templateIdList = []
templateNameList = []
templateFileList = []
for row in data:
	templateIdList.append(row[0]);
	templateNameList.append(row[1]);
	if side == 'LEFT':
		templateFileList.append(row[2]);
	else:
		templateFileList.append(row[3]);
	
#	convert template data to PNG
for i in range(len(templateFileList)):

	fullname1 = templateFileList[i]
	fileExt1 = fullname1.rpartition(".")[-1]
	fileName1 = fullname1.rpartition(".")[-3]

	if not os.path.isfile('Turtle/'+fileName1+'.PNG'):
		#convert to PNG
		im = Image.open('Turtle/'+fullname1)
		im.save('Turtle/'+fileName1+'.PNG')

	if not os.path.isfile('Turtle/'+fileName1+'.PNG'):
		print 'Cannot find name with '+fileName1+'.PNG'
		sys.exit()
	else:
		templateFileList[i] = 'Turtle/'+fileName1+'.PNG'
	

#	calculate matching score for left and right template
leftScore=[]
leftOutName = []
leftRawScore=[]
rightScore=[]
rightOutName = []
rightRawScore=[]
for index in range(len(templateFileList)):
	if side == 'LEFT':
		realInputName = useThisFileName
		realNameTemplate = templateFileList[index].rpartition(".")[-3].rpartition("/")[-1]
		#	compare with left face
		leftFaceName = templateFileList[index]
		outputVName = "./Output/"+realInputName+"-"+realNameTemplate+"V_LEFT.PNG"
		outputHName = "./Output/"+realInputName+"-"+realNameTemplate+"H_LEFT.PNG"
		outputMatchingName = "./Output/"+realInputName+"-"+realNameTemplate+"Mathcing_LEFT.txt"
		outputKeys1Name = "./RawFile/"+realNameTemplate+"Keys_LEFT.txt"
		outputKeys2Name = "./RawFile/"+realInputName+"Keys.txt"
		leftOutName.append(outputVName)
		
		histogram_match( fileInputName, templateFileList[index])
		command_line = "./demo_ASIFT"+" "+leftFaceName+" ./Input/hist_matched.PNG "+outputVName+" "+outputHName+" "+outputMatchingName+" "+outputKeys1Name+" "+outputKeys2Name

        	args = shlex.split(command_line)
		p = subprocess.Popen(args)
		p.wait()
		scoreFile = open(outputMatchingName)
		count=1
		for line in scoreFile:
			if count==1:
				score = line.strip()
				score = float(score)
				leftScore.append(score)
				count=count+1
			
			elif count==2:
				score = line.strip()
				score = float(score)*(-1.0)
				leftRawScore.append(score)
				count=count+1
			else:
				break
	
	if side == 'RIGHT':
		realInputName = useThisFileName
		realNameTemplate = templateFileList[index].rpartition(".")[-3].rpartition("/")[-1]
		#	compare with left face
		rightFaceName = templateFileList[index]
		outputVName = "./Output/"+realInputName+"-"+realNameTemplate+"V_RIGHT.PNG"
		outputHName = "./Output/"+realInputName+"-"+realNameTemplate+"H_RIGHT.PNG"
		outputMatchingName = "./Output/"+realInputName+"-"+realNameTemplate+"Mathcing_RIGHT.txt"
		outputKeys1Name = "./RawFile/"+realNameTemplate+"Keys_LEFT.txt"
		outputKeys2Name = "./RawFile/"+realInputName+"Keys.txt"
		rightOutName.append(outputVName)
		
		histogram_match( fileInputName, templateFileList[index])
		command_line = "./demo_ASIFT"+" "+rightFaceName+" ./Input/hist_matched.PNG "+outputVName+" "+outputHName+" "+outputMatchingName+" "+outputKeys1Name+" "+outputKeys2Name

		args = shlex.split(command_line)
		p = subprocess.Popen(args)
		p.wait()
		scoreFile = open(outputMatchingName)
		count=1
		for line in scoreFile:
			if count==1:
				score = line.strip()
				score = float(score)
				rightScore.append(score)
				count=count+1
			elif count==2:
				score = line.strip()
				score = float(score)*(-1.0)
				rightRawScore.append(score)
				count=count+1
			else:
				break

#	list score and print
leftIndex = sorted(range(len(leftRawScore)),key=lambda x:leftRawScore[x])[::-1]
rightIndex = sorted(range(len(rightRawScore)),key=lambda x:rightRawScore[x])[::-1]
if side == 'LEFT':
	for index in leftIndex:
		leftPercent = leftScore[index]
		leftRawScoreData = leftRawScore[index]
		print "$"+ str(templateIdList[index])+","+ str(leftPercent) + ",LEFT,"+leftOutName[index]+","+str(leftRawScoreData)	

if side == 'RIGHT':
	for index in rightIndex:
		rightPercent = rightScore[index]
		rightRawScoreData = rightRawScore[index]
		print "$"+ str(templateIdList[index])+","+ str(rightPercent) + ",RIGHT,"+rightOutName[index]+","+str(rightRawScoreData)	
	
