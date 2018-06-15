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

#   input name
inputName = sys.argv[1]
#	side to matching
side = sys.argv[2]


fileName = inputName[9:len(inputName)-4]

fileInputName = ''

#	if file is jpg or JPG
if not os.path.isfile('Turtle/'+fileName+'.PNG'):
	im = Image.open(inputName)
	im.save('Turtle/'+fileName+'.PNG')
	
if not os.path.isfile('Turtle/'+fileName+'.PNG'):
	print 'Cannot find name with '+fileName+'.PNG'
	sys.exit()
else:
	fileInputName='Turtle/'+fileName+'.PNG'

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
		templateFileList.append("Turtle/"+str(row[0])+"_Left.png");
	else:
		templateFileList.append("Turtle/"+str(row[0])+"_Right.png");

	
#	convert template data to PNG
for i in range(len(templateFileList)):

	fullname1 = templateFileList[i]
	
	fileName1 = fullname1[7:len(fullname1)-4]

	print "filename1", fileName1

	if not os.path.isfile('Turtle/'+fileName1+'.PNG'):
		#convert to PNG
		im = Image.open(fullname1)
		im.save('Turtle/'+fileName1+'.PNG')

	if not os.path.isfile('Turtle/'+fileName1+'.PNG'):
		print 'Cannot find name with '+fileName1+'.PNG'
		sys.exit()
	else:
		templateFileList[i] = 'Turtle/'+fileName1+'.PNG'
	

#	calculate matching score for left and right template
leftScore=[]
leftOutName = []
rightScore=[]
rightOutName = []
for index in range(len(templateFileList)):
	if side == 'LEFT':
		realInputName = fileName+"Match-"
		realNameTemplate = str(templateIdList[index])+"Turtle-"
		#	compare with left face
		leftFaceName = templateFileList[index]
		outputVName = "./Output/"+realInputName+"-"+realNameTemplate+"V_LEFT.PNG"
		outputHName = "./Output/"+realInputName+"-"+realNameTemplate+"H_LEFT.PNG"
		outputMatchingName = "./Output/"+realInputName+"-"+realNameTemplate+"Mathcing_LEFT.txt"
		outputKeys1Name = "./RawFile/"+realNameTemplate+"Keys_LEFT.txt"
		outputKeys2Name = "./RawFile/"+realInputName+"Keys.txt"
		leftOutName.append(outputVName)
		command_line = "./demo_ASIFT"+" "+leftFaceName+" "+fileInputName+" "+outputVName+" "+outputHName+" "+outputMatchingName+" "+outputKeys1Name+" "+outputKeys2Name

		print command_line

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
		realInputName = fileName+"Match-"
		realNameTemplate = str(templateIdList[index])+"Turtle-"
		#	compare with left face
		rightFaceName = templateFileList[index]
		outputVName = "./Output/"+realInputName+"-"+realNameTemplate+"V_RIGHT.PNG"
		outputHName = "./Output/"+realInputName+"-"+realNameTemplate+"H_RIGHT.PNG"
		outputMatchingName = "./Output/"+realInputName+"-"+realNameTemplate+"Mathcing_RIGHT.txt"
		outputKeys1Name = "./RawFile/"+realNameTemplate+"Keys_LEFT.txt"
		outputKeys2Name = "./RawFile/"+realInputName+"Keys.txt"
		rightOutName.append(outputVName)
		command_line = "./demo_ASIFT"+" "+rightFaceName+" "+fileInputName+" "+outputVName+" "+outputHName+" "+outputMatchingName+" "+outputKeys1Name+" "+outputKeys2Name

		print command_line
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
leftIndex = sorted(range(len(leftScore)),key=lambda x:leftScore[x])[::-1]
rightIndex = sorted(range(len(rightScore)),key=lambda x:rightScore[x])[::-1]
if side == 'LEFT':
	for index in leftIndex:
		leftPercent = leftScore[index]
		print "$"+ templateIdList[index]+","+ str(leftPercent) + ",LEFT,"+leftOutName[index]	

if side == 'RIGHT':
	for index in rightIndex:
		rightPercent = rightScore[index]
		print "$"+ templateIdList[index]+","+ str(rightPercent) + ",RIGHT,"+rightOutName[index]
	
