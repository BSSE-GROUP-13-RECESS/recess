<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        DB::insert("insert into Hospitals (hospitalName, Type) VALUES
                            ('Butabika National Referral Hospital','National_referral_Hospital'),('Mulago National Referral Hospital','National_referral_Hospital'),('Arua Regional Referral Hospital','Regional_Referral_Hospital'),('Fort Portal Regional Referral Hospital','Regional_Referral_Hospital'),('Gulu Regional Referral Hospital','Regional_Referral_Hospital'),('Hoima Regional Referral Hospital','Regional_Referral_Hospital'),('Jinja Regional Referral Hospital','Regional_Referral_Hospital'),('Kabale Regional Referral Hospital','Regional_Referral_Hospital'),('Old Mulago Hospital','Regional_Referral_Hospital'),('Lira Regional Referral Hospital','Regional_Referral_Hospital'),('Masaka Regional Referral Hospital','Regional_Referral_Hospital'),('Mbale Regional Referral Hospital','Regional_Referral_Hospital'),('Mbarara Regional Referral Hospital','Regional_Referral_Hospital'),('Moroto Regional Referral Hospital','Regional_Referral_Hospital'),('Mubende Regional Referral Hospital','Regional_Referral_Hospital'),('Soroti Regional Referral Hospital','Regional_Referral_Hospital'),('Abim General Hospital','General_Hospital'),('Adjumani General Hospital','General_Hospital'),('Anaka General Hospital','General_Hospital'),('Apac General Hospital','General_Hospital'),('Atutur General Hospital','General_Hospital'),('Bududa General Hospital','General_Hospital'),('Bugiri General Hospital','General_Hospital'),('Bukwo General Hospital','General_Hospital'),('Bundibugyo General Hospital','General_Hospital'),('Busolwe General Hospital','General_Hospital'),('Iganga General Hospital','General_Hospital'),('Itojo Hospital','General_Hospital'),('Kaabong General Hospital','General_Hospital'),('Kagadi General Hospital','General_Hospital'),('Kalisizo General Hospital','General_Hospital'),('Kamuli General Hospital','General_Hospital'),('Kapchorwa General Hospital','General_Hospital'),('Kasese Municipal Health Centre III','General_Hospital'),('Katakwi General Hospital','General_Hospital'),('Kawolo General Hospital','General_Hospital'),('Kayunga Hospital','General_Hospital'),('Kiboga General Hospital','General_Hospital'),('Kiryandongo General Hospital','General_Hospital'),('Kitagata General Hospital','General_Hospital'),('Kitgum Hospital','General_Hospital'),('Kyenjojo General Hospital','General_Hospital'),('Lyantonde General Hospital','General_Hospital'),('Masafu General Hospital','General_Hospital'),('Masindi General Hospital','General_Hospital'),('Mityana Hospital','General_Hospital'),('Moyo General Hospital','General_Hospital'),('Mpigi Hospital','General_Hospital'),('Nakaseke General Hospital','General_Hospital'),('Nebbi General Hospital','General_Hospital'),('Pallisa General Hospital','General_Hospital'),('Rakai General Hospital','General_Hospital'),('Tororo General Hospital','General_Hospital'),('Yumbe General Hospital','General_Hospital'),('Buwenge General Hospital','General_Hospital'),('Bwera General Hospital','General_Hospital'),('Entebbe General Hospital','General_Hospital'),('Iran–Uganda Hospital','General_Hospital'),('Kawempe General Hospital','General_Hospital'),('Kiruddu General Hospital','General_Hospital'),('Naguru General Hospital','General_Hospital'),('Ishaka Adventist Hospital','General_Hospital'),('Kagando Hospital','General_Hospital'),('Kalongo Hospital','General_Hospital'),('Kamuli Mission Hospital','General_Hospital'),('Kilembe Mines Hospital','General_Hospital'),('Kisiizi Hospital','General_Hospital'),('Kisubi Hospital','General_Hospital'),('Kitojo Hospital','General_Hospital'),('Kitovu Hospital','General_Hospital'),('Kiwoko Hospital','General_Hospital'),('Kuluva Hospital','General_Hospital'),('Lacor Hospital','General_Hospital'),('Lubaga Hospital','General_Hospital'),('Lwala Hospital Kaberamaido','General_Hospital'),('Makerere University Hospital','General_Hospital'),('Matany Hospital','General_Hospital'),('Mayanja Memorial Hospital','General_Hospital'),('Mengo Hospital','General_Hospital'),('Mildmay Uganda Hospital','General_Hospital'),('Mutolere Hospital','General_Hospital'),('Naggalama Hospital','General_Hospital'),('Ngora Hospital','General_Hospital'),('Nkokonjeru Hospital','General_Hospital'),('Nkozi Hospital','General_Hospital'),('Nsambya Hospital','General_Hospital'),('Pope John’s Hospital Aber','General_Hospital'),('Nyenga Mission Hospital','General_Hospital'),('Ruharo Mission Hospital','General_Hospital'),('Rushere Community Hospital','General_Hospital'),('St. Charles Lwanga Buikwe Hospital','General_Hospital'),('St. Francis Hospital Nkokonjeru','General_Hospital'),('St. Francis Hospital Nyenga','General_Hospital'),('St. Josephs Hospital Kitgum','General_Hospital'),('St. Josephs Hospital Maracha','General_Hospital'),('Uganda Martyrs’ Hospital Ibanda','General_Hospital'),('Villa Maria Hospital','General_Hospital'),('Virika Hospital','General_Hospital');");
        DB::insert("insert into Staff(staffUsername, hospitalId, staffFullName) VALUES
                            ('director1',1,'unknown'),('director2',2,'unknown'),('Staff1',1,'Deogratious D Kiyingi'),('Staff2',1,'Veronica Nanyondo'),('Staff3',1,'Muwanga M Kivumbi'),('Staff4',1,'Lyandro Komakech'),('Staff5',1,'Peter Okot'),('Staff6',1,'Joseph Ssewungu'),('Staff7',1,'Allan Ssewanyana'),('Staff8',1,'Florence Namayanja'),('Staff9',1,'Mathias Mpuuga'),('Staff10',1,'Mary Babirye Kabanda'),('Staff11',1,'Betty Nambooze Bakireke'),('Staff12',1,'Luttamaguzi Semakula Paulson'),('Staff13',1,'Medard Lubega Sseggona'),('Staff14',1,'Ssempala Kigozi Emmanuel'),('Staff15',1,'Musoke Nsereko Wakayima'),('Staff16',1,'Aadroa Alex Onzima'),('Staff17',1,'Aceng Jane Ruth'),('Staff18',1,'Byaruhanga William'),('Staff19',1,'Egunyu Akiror Agnes'),('Staff20',1,'Kafura Joy Kabatsi'),('Staff21',1,'Kahinda Otafiire'),('Staff22',1,'Kamya Beti'),('Staff23',1,'Kataaha Museveni Janet'),('Staff24',1,'Kirunda Kivejinja'),
                            ('Staff25',2,'Mateke Philemon'),('Staff26',2,'Mukwaya Balunzi Janat'),('Staff27',2,'Muloni Irene'),('Staff28',2,'Mutuuzo Peace Regis'),('Staff29',2,'Nadduli Abdul'),('Staff30',2,'Nakiwala Florence KiyingI'),('Staff31',2,'Ntege Azuba'),('Staff32',2,'Ruhakana Rugunda'),('Staff33',2,'Tumukunde Henry'),('Staff34',2,'Ogenga Latigo Moris'),('Staff35',2,'Akello Judith Franca'),('Staff36',2,'Akol Anthony'),('Staff37',2,'Olanya Gilbert'),('Staff38',2,'Lucy Akello'),('Staff39',2,'Francis Mwijukye'),('Staff40',2,'Cecilia Ogwal'),('Staff41',2,'Reagan Okumu'),('Staff42',2,'Betty Aol Ochan');");

        Schema::table('users',function (Blueprint $table){
          $table->foreign('director')->references('staffUsername')->on('Staff')->cascadeOnUpdate();
        });

        DB::insert("insert into users (name,email,password,director,created_at,updated_at) VALUES
                            ('unknown','unknown1@unknown','password','director1',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP),('unknown','unknown2@unknown','password','director2',CURRENT_TIMESTAMP,CURRENT_TIMESTAMP);");
        DB::unprepared("
            CREATE TRIGGER change_status after insert on Patients for each row
            BEGIN
                update Covid19HealthOfficer set present='No, was promoted' where username in
                (select CHOUsername from Patients group by CHOUsername having count(CHOUsername)>=5) and present='Yes';
                update SenCovid19HealthOfficer set present='No, was promoted' where username in
                (select SCHOUsername from Patients group by SCHOUsername having count(SCHOUsername)>=5) and present='Yes';
            END;
            
            
            CREATE PROCEDURE ToSenior()
            BEGIN
                DECLARE counter INT DEFAULT 1;
                delete from HospitalHeads where head in (select username from Covid19HealthOfficer where present!='Yes');
                select @cnt1:=count(*) from (select username from Covid19HealthOfficer where present='No, was promoted' and username not in
                (select username from SenCovid19HealthOfficer)) as tempt1 into @nothing1;
            
                REPEAT
                select @user:=username from Covid19HealthOfficer where present='No, was promoted' and username not in
                (select username from SenCovid19HealthOfficer) into @nothing1;
            
                select @cnt2:=count(*) from (select @hosp:=hospitalId from Hospitals where Type='Regional_Referral_Hospital' and hospitalId
                not in (select hospitalId from SenCovid19HealthOfficer) limit 1) as tempt2 into @nothing1;
            
                IF (@cnt2>0) THEN
                    insert into SenCovid19HealthOfficer (username, hospitalId) values (@user,@hosp);
                ELSE
                    select @hosp:=hospitalId, min(number) from (select hospitalId, count(hospitalId) as 'number' from SenCovid19HealthOfficer where present='Yes' group by hospitalId) as tempt3 group by hospitalId into @nothing1,@nothing2;
                    insert into SenCovid19HealthOfficer (username, hospitalId) values (@user,@hosp);
                END IF;
                SET counter = counter + 1;
                UNTIL counter >= @cnt1
                END REPEAT;
            END;
            
            CREATE PROCEDURE ToConsultant()
            BEGIN
                delete from HospitalHeads where head in (select username from SenCovid19HealthOfficer where present!='Yes');
                DECLARE counter INT DEFAULT 1;
                select @cnt1:=count(*) from (select username from SenCovid19HealthOfficer where present='No, was promoted' and username not in
                (select username from Covid19Consultant)) as tempt1 into @nothing1;
            
                REPEAT
                    select @user:=username from SenCovid19HealthOfficer where present='No, was promoted' and username not in
                    (select username from Covid19Consultant) into @nothing1;
            
                    select @cnt2:=count(*) from (select @hosp:=hospitalId from Hospitals where Type='National_Referral_Hospital' and hospitalId
                    not in (select hospitalId from Covid19Consultant) limit 1) as tempt2 into @nothing1;
            
                    IF (@cnt2>0) THEN
                        insert into Covid19Consultant (username, hospitalId) values (@user,@hosp);
                    ELSE
                        select @hosp:=hospitalId, min(number) from (select hospitalId, count(hospitalId) as 'number' from Covid19Consultant where present='Yes' group by hospitalId) as tempt3 group by hospitalId into @nothing1,@nothing2;
                        insert into Covid19Consultant (username, hospitalId) values (@user,@hosp);
                    END IF;
                    SET counter = counter + 1;
                    UNTIL counter >= @cnt1
                END REPEAT;
            END;
             ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
      Schema::table('users',function (Blueprint $table){
        $table->dropConstrainedForeignId('director');
      });
      DB::unprepared("drop trigger change_status;
                    drop procedure ToSenior;
                    drop procedure ToConsultant;
                    ");
    }
}
