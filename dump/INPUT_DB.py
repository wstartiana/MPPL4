import mysql.connector
import json

with open("dump_SD_S.json") as bb :
    c = json.load(bb)

for ind in c :
    # pertama

    # mydb = mysql.connector.connect(host="localhost", user="root",passwd="namamu",database="sekolahq")

    # mycursor = mydb.cursor()


    # sql = "INSERT INTO  deskripsi (nama_sekolah, kuota) VALUES (%s, %s)"
    # val = (ind['nama_sekolah'], ind['total_siswa'])
    # mycursor.execute(sql, val)

    # mydb.commit()

    # mydb.close()


    # # kedua
    mydb = mysql.connector.connect(host="localhost", user="root",passwd="namamu",database="sekolahq")


    mycursor = mydb.cursor()

    sql = "INSERT INTO peta (nama_sekolah, latitude, longitude) VALUES (\"%s\", %f, %f)"
    val = (ind['nama_sekolah'], float(ind['lat']), float(ind['long']) )
    # print(sql%val)
    mycursor.execute(sql % val)

    mydb.commit()

    mydb.close()





    # ketiga
    
    if ind['status'] == "S" :
        statu = 0
    else :
        statu = 1

    
    

    
    

    mydb = mysql.connector.connect(host="localhost", user="root",passwd="namamu",database="sekolahq")

    mycursor = mydb.cursor()


    sql = "INSERT INTO sekolah (nama_sekolah, kepala_sekolah, akreditasi, alamat_sekolah, status, jenjang, email, no_telp, kurikulum, total_siswa) VALUES (\"%s\", \"%s\", \"%s\", \"%s\", %d, \"%s\", \"%s\", \"%s\", \"%s\", \"%s\")"
    val = (ind['nama_sekolah'], ind['kepala_sekolah'], ind['akreditasi'], ind['alamat_sekolah'], statu, ind['jenjang'], ind['email'], ind['no_telp'], ind['kurikulum'], ind['total_siswa'] )
    # print(sql%val)
    mycursor.execute(sql % val)

    mydb.commit()

    mydb.close()


    print(mycursor.rowcount, "record inserted.")    