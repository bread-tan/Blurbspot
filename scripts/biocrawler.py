import urllib
import re
import os



def main(artistname):
    artistlist =[]
    artist = ' '.join(artistname.split('_'))
    print makelinks(artist)

def makelinks(artist):
    pagelink = ''
    #directory=''
    bioexp = "<div id=\"wiki\">(.+)</div><!-- #wiki -->"
    #filename = ''
    pagelink = 'http://www.last.fm/music/'
    #directory = 'C:/Users/Rohit/Desktop/Blurbspot/'
        
    #filename = ''
    words = artist.split()
    wordcount = 0
    for word in words:
        if wordcount == len(words)-1:
            pagelink = pagelink + word
            #directory = directory + word
                
                
        else:
            pagelink = pagelink + word + '+'
            #directory = directory + word + '-'
                
        #filename = filename + word +'_'
        wordcount+=1
            
    pagelink = pagelink + '/+wiki'
    #directory = directory + '/'
       
    #filename = filename + 'bio.txt'
    bio = getbio(pagelink, bioexp)
    #makefile(directory,filename,bio)
    return bio

def getbio(pagelink,bioexp):
    
    page = urllib.urlopen(pagelink).read()
    page=" ".join(page.split())
    bio = ''.join(re.findall(bioexp,page))
    bio = re.sub('<br />','\n',bio)
    bio = re.sub('<[^<]+?>', '', bio)
    #print bio
    return bio


    

    
    



#crawlbio()
if __name__ == '__main__':
	import sys
	if len(sys.argv)<2:
		print "python biocrawler.py artistname"
		sys.exit()
	main(sys.argv[1])
