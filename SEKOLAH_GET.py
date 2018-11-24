import requests

from bs4 import BeautifulSoup

all_link = []


# ambil berapa banyak sekolah

payload = {'page': '1', 'kode_kabupaten': '026100', 'kode_kec': '', 'bentuk':'SD', 'status':'N', 'akreditasi':'A', 'sekolah':'' }

r = requests.post('http://sekolah.data.kemdikbud.go.id/index.php/chome/pencarian/', data =payload)
parsed = BeautifulSoup(r.text,"lxml")

jumlah_sekolah = int (parsed.body.find('ul', attrs={'class':'pagination pull-left','id':'list'}).findChild('a').string.split(' ')[0])
print("Jumlah sekolah:",jumlah_sekolah)

for no_page in range(0,jumlah_sekolah):

    payload = {'page': no_page+1, 'kode_kabupaten': '026100', 'kode_kec': '', 'bentuk':'SD', 'status':'N', 'akreditasi':'A', 'sekolah':'' }

    r = requests.post('http://sekolah.data.kemdikbud.go.id/index.php/chome/pencarian/', data =payload)

    parsed = BeautifulSoup(r.text,"lxml")

    list_link = parsed.body.find_all('a', attrs={'class':'btn btn-default btn-sm','target':'_blank'})

    for i in list_link:
        all_link += i['href']
        # print i['href']

        data_sekolah = requests.get('http://sekolah.data.kemdikbud.go.id'+ i['href'])
# data_sekolah = requests.get('http://sekolah.data.kemdikbud.go.id/index.php/chome/profil/163BC6C8-ACBE-487B-AAF4-FED45C7CE934')

        parsed_sekolah = BeautifulSoup(data_sekolah.text,"lxml")

        # ambil nama sekolah & alamat
        parsed_sekolah.body.find('h4', attrs={'class':'page-header'}).find('a').decompose()
        teks_awal = parsed_sekolah.body.find('h4', attrs={'class':'page-header'}).text

        # buang alamat skolah
        parsed_sekolah.body.find('h4', attrs={'class':'page-header'}).find('small').decompose()
        nama_sekolah = parsed_sekolah.body.find('h4', attrs={'class':'page-header'}).text

        alamat_sekolah = teks_awal.replace(nama_sekolah,'').strip()
        nama_sekolah = nama_sekolah[nama_sekolah.find(" ")+1:]

        kepala_sekolah = data_sekolah.text[data_sekolah.text.find("Kepala Sekolah : "):] # mulai dari kata kepala sekolah :
        kepala_sekolah = kepala_sekolah[kepala_sekolah.find(":")+2:kepala_sekolah.find("<")]

        # rombongan_belajar = 

        akreditasi = data_sekolah.text[data_sekolah.text.find("Akreditasi : "):]
        akreditasi = akreditasi[13:akreditasi.find('<')]

        # ambil lat & lon
        script_js = str(parsed_sekolah.body.find('script', attrs={'language':'javascript'}).string)
        script_js = script_js[script_js.index('var marker = L.marker(L.latLng(')+31:]
        script_js = script_js[:script_js.index(')')]
        latitude = script_js.split(',')[0]
        longitude = script_js.split(',')[1]

        print nama_sekolah
        print kepala_sekolah
        print akreditasi
        print alamat_sekolah


        print latitude
        print longitude
        print ''