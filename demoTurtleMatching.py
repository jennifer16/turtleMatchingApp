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
#	user 
user_id =sys.argv[3]

fileExt = inputName.rpartition(".")[-1]
fileName = inputName.rpartition(".")[-3]

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
templateNameList = []
templateFileList = []
for row in data:
	templateNameList.append(row[1]);
	if side == 'LEFT':
		templateFileList.append(row[2]);
	else:
		templateFileList.append(row[3]);
	
#	convert template data to PNG
for i in range(len(templateFileList)):

	fullname = templateFileList[i]
	fileExt = fullname.rpartition(".")[-1]
	fileName = fullname.rpartition(".")[-3]

	if not os.path.isfile('Turtle/'+fileName+'.PNG'):
		#convert to PNG
		im = Image.open('Turtle/'+fullname)
		im.save('Turtle/'+fileName+'.PNG')

	if not os.path.isfile('Turtle/'+fileName+'.PNG'):
		print 'Cannot find name with '+fileName+'.PNG'
		sys.exit()
	else:
		templateFileList[i] = 'Turtle/'+fileName+'.PNG'
	

#	calculate matching score for left and right template
leftScore=[]
rightScore=[]
for index in range(len(templateFileList)):
	if side == 'LEFT':
		realNameTemplate = templateNameList[index];
		#	compare with left face
		leftFaceName = name
		outputVName = "./Output/"+user_id+"-"+realNameTemplate+"V_LEFT.PNG"
		outputHName = "./Output/"+user_id+"-"+realNameTemplate+"H_LEFT.PNG"
		outputMatchingName = "./Output/"+user_id+"-"+realNameTemplate+"Mathcing_LEFT.txt"
		outputKeys1Name = "./RawFile/"+realNameTemplate+"Keys_LEFT.txt"
		outputKeys2Name = "./RawFile/"+"Keys.txt"

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
for index in range(len(templateFileList)):
	if side == 'LEFT':
		leftPercent = leftScore[index]
		print "$"+ templateFileName[index]+","+ str(leftPercent) + ",LEFT"	
	
	if side == 'RIGHT':			
		rightPercent = rightScore[index]
		print "$"+ templateFileNameDict[templateFileNameDict.keys()[index]]+","+ str(rightPercent) + ",RIGHT"
		
	
