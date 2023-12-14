
/*
 * be warned some of the tables were edited midway or 
 * were cut
 */
Create table insurance (
insuranceID int generated always as identity,
out_of_pocket_max numeric(9,2) NOT NULL,
tier int,
policyy int NOT NULL,
Primary key(insuranceID)
);

Create table patient (
patientID int generated always as identity,
gender char(1) NOT NULL,
pronouns varchar(10),
DOB date NOT NULL,
description text,
username varchar(50) NOT NULL,
passwordd varchar(50) NOT NULL,
is_minor boolean NOT NULL,
has_gaurdian boolean NOT NULL,
TIN numeric(12) NOT NULL,
insuranceID int,
first_name varchar(30) NOT NULL,
last_name varchar(30) NOT NULL,
phone_number numeric(10) NOT NULL,
email varchar(40),
state char(2),
city text,
street text NOT NULL,
zip_code int NOT null check (zip_code <= 99999),
is_P_O_box bool, 
Primary key(patientID),
Foreign key (insuranceID) references insurance(insuranceID)
);

create table next_of_kin (
next_of_kinID int generated always as identity,
patientID int NOT NULL,
first_name varchar(30) NOT NULL,
last_name varchar(30) NOT NULL,
phone_number numeric(10) NOT NULL,
email varchar(40) NOT NULL,
state char(2) NOT NULL,
city varchar(40) NOT NULL,
street varchar(40) NOT NULL,
zip_code int NOT null check (zip_code <= 99999),
Primary key(next_of_kinID),
Foreign key (patientID) references patient(patientID)
);

create table emergency_contact (
emergency_contactID int generated always as identity,
relation varchar(30) NOT NULL,
patientID int NOT NULL,
first_name varchar(30) NOT NULL,
last_name varchar(30) NOT NULL,
phone_number numeric(10) NOT null,
email varchar(40),
Primary key(emergency_contactID),
Foreign key (patientID) references patient(patientID)
);



create table payment (
paymentID int generated always as identity,
patientID int NOT NULL,
statement_made date NOT NULL,
service_made date NOT NULL,
service_provided varchar(40) NOT NULL,
total_charge numeric(9,2) NOT NULL,
deductable numeric(9,2),
copay numeric(9,2),
insurance_payment  numeric(9,2),
patient_payment numeric(9,2) NOT NULL,
due_date date NOT NULL,
Primary key(paymentID),
Foreign key (patientID) references patient(patientID)
);



Create table practitioner_role (
job text NOT NULL,
permissionn numeric(2) NOT NULL,
Primary key(job)
);

Create table practitioner (
practitionerID int generated always as identity,
job text NOT NULL,
DOB date NOT NULL,
username varchar(50) NOT NULL,
passwordd varchar(50) NOT NULL,
description text,
first_name varchar(30) NOT NULL,
last_name varchar(30) NOT NULL,
phone_number numeric(10) NOT NULL,
email varchar(40) NOT NULL,
state char(2),
city text,
street text NOT NULL,
zip_code int NOT null check (zip_code <= 99999),
is_P_O_box bool,
Primary key(practitionerID),
Foreign key (job) references practitioner_role(job)
);



Create table practitioner_patient (
practitionerID int NOT NULL,
patientID int NOT NULL,
Foreign key (practitionerID) references practitioner(practitionerID),
Foreign key (patientID) references patient(patientID)
);



Create table proceduree (
proceduree text NOT NULL,
Primary key(proceduree)
);

Create table test (
test text NOT NULL,
Primary key(test)
);

Create table lab (
lab text NOT NULL,
Primary key(lab)
);

Create table recomended_labs (
recomended_labsID int generated always as identity,
lab text NOT NULL,
patientID int NOT NULL,
date_recommend date NOT NULL,
notes text,
Primary key(recomended_labsID),
Foreign key (patientID) references patient(patientID),
Foreign key (lab) references lab(lab)
);

Create table recomended_procedures (
recomended_proceduresID int generated always as identity,
proceduree text NOT NULL,
patientID int NOT NULL,
date_recommend date NOT NULL,
notes text,
Primary key(recomended_proceduresID),
Foreign key (proceduree) references proceduree(proceduree),
Foreign key (patientID) references patient(patientID)
);

Create table recomended_tests (
recomended_testsID int generated always as identity,
test text NOT NULL,
patientID int NOT NULL,
date_recommend date NOT NULL,
notes text,
Primary key(recomended_testsID),
Foreign key (patientID) references patient(patientID),
Foreign key (test) references test(test)
);

Create table a_type (
aname text NOT NULL,
Primary key(aname)
);

Create table appointment (
appointmentID int generated always as identity,
aname text,
lab text,
proceduree text,
test text,
appointment_date date NOT NULL,
note text,
practitionerID int NOT NULL,
startt timestamp without time zone NOT NULL,
endd timestamp without time zone NOT NULL,
patientID int NOT NULL,
Primary key(appointmentID),
Foreign key (aname) references a_type(aname),
Foreign key (lab) references lab(lab),
Foreign key (proceduree) references proceduree(proceduree),
Foreign key (test) references test(test),
Foreign key (practitionerID) references practitioner(practitionerID),
Foreign key (patientID) references patient(patientID)
);



Create table medicine (
medicine_name text NOT NULL,
generic_name text NOT NULL,
Primary key(medicine_name)
);

Create table pharmacy (
pharmacyID int generated always as identity,
pharm_name varchar(50) NOT NULL,
phone_number numeric(10) NOT NULL,
email varchar(40) NOT NULL,
state char(2) NOT NULL,
city varchar(40) NOT NULL,
street varchar(40) NOT NULL,
zip_code int NOT null check (zip_code <= 99999),
Primary key(pharmacyID)
);

Create table medicine_order (
medicine_orderID int generated always as identity,
refills int NOT NULL,
take_every varchar(30) NOT NULL,
dose int NOT NULL,
stop_by date NOT NULL,
submit_date date NOT NULL,
patientID int NOT NULL,
medicine_name text NOT NULL,
practitionerID int NOT NULL,
Primary key(medicine_orderID),
Foreign key (patientID) references patient(patientID),
Foreign key (medicine_name) references medicine(medicine_name),
Foreign key (practitionerID) references practitioner(practitionerID)
);



Create table problem_record (
problem_recordID int generated always as identity,
practitionerID int,
patientID int NOT NULL,
appointmentID int,
submit_date date NOT NULL,
Nose_Bleeds bool,
Stuffiness bool,
Frequent_Colds bool,
Asthma bool,
Hearing bool,	
Ear_Pain bool, 	
Ear_Discharge bool, 	
Ringing bool, 	
Dizziness bool,
Glasses bool, 	
Change_in_Vision bool, 	
Eye_Pain bool, 	
Double_Vision bool, 	
Light_Flashes bool, 	
Glaucoma bool,
eye_exam date,
Hives bool, 	
Hay_Fever bool, 	
Eczema bool, 	
Lip_or_Tongue_Swelling bool, 	
Food_Drug_Pollen_sensitivity bool,
Anxiety bool, 	
Memory bool, 	
sleep_issues bool, 	
Mood bool, 	
Depression bool, 	
Unusual_Problem bool,
Bleeding_Gums bool, 	
Sore_Tongue bool, 	
Sore_Throat bool, 	
Hoarseness bool,
n_Lumps bool, 	
Goiter bool, 	
Swollen_Glands bool, 	
Neck_Stiffness bool,
b_Lumps bool, 	
Breast_Pain bool, 	
Nipple_Discharge bool, 	
Self_Exam bool,
Leg_Cramps bool,
Varicose_Veins bool, 	
Blood_Clots bool, 	
Muscle_Pain bool, 	
Muscle_Swelling bool, 	
Muscle_Stiffness bool,
Joint_Motion bool, 	
Broken_Bone bool, 	
Sprains bool, 	
arthritis bool, 	
Gout bool,
Seizures bool, 	
Fainting bool, 	
Paralysis bool, 	
Weakness bool, 	
Muscle_Size bool,	
Muscle_Spasm bool,
Tremor bool, 	
Involuntary_Movement bool, 	
Incoordination bool, 
Numbness bool, 	
Pin_or_Needle_Sensation bool,
Growth bool, 	
Appetite bool, 	
Thirst bool, 	
Thyroid bool, 	
Sweating bool, 	
Increased_Urination bool, 	
Diabetes bool,
Swallowing bool, 	
Nausea bool, 	
Heartburn bool, 	
Vomiting bool, 	
Vomiting_Blood bool, 	
Constipation bool,
Diarrhea bool, 	
Bowels bool, 	
Abdominal_Pain bool, 	
Burping bool, 	
Farting bool, 	
Yellow_Skin bool,
Food_Intolerance bool, 	
Rectal_Bleeding bool, 	
Urination bool, 	
Urination_Pain bool, 	
Frequent_Urination bool, 	
Urgent_Urination bool,
Incotinence bool, 	
Dribble bool,
Shortness_of_Breath bool,	
Cough bool, 	
Phlegm bool, 
Wheezing bool, 	
Bloody_Cough bool, 	
Chest_Pain bool,
Fever bool, 	
Night_Sweats bool, 	
Swollen_Hands bool, 	
Blue_Toes bool, 	
Hypertension bool, 	
Irregular_Heartbeat bool,
Heart_Murmur bool, 	
Rheumatic_Fever bool, 	
Bronchitis bool, 	
Heart_Medication bool,
Anemia bool, 	
Easy_Brusing bool, 	
Transfusion bool,
note text,
Primary key(problem_recordID),
Foreign key (practitionerID) references practitioner(practitionerID),
Foreign key (patientID) references patient(patientID),
Foreign key (appointmentID) references appointment(appointmentID)
);

Create table system_overview (
system_overviewID int generated always as identity,
appointmentID int,
practitionerID int,
patientID int NOT NULL, 
height float NOT NULL,
p_weight float NOT NULL, 
s_blood_pressure int NOT NULL, 
d_blood_pressure int NOT NULL,
pulse int NOT NULL,
BMI float NOT NULL,
temperature float NOT NULL,
O2_sat int NOT NULL, 
date timestamp without time zone NOT NULL,
Primary key(system_overviewID),
Foreign key (patientID) references patient(patientID),
Foreign key (practitionerID) references practitioner(practitionerID)
);

create table family_history (
family_historyID int generated always as identity,
patientID int NOT NULL,
relationship varchar(40) NOT NULL,
Primary key(family_historyID),
Foreign key (patientID) references patient(patientID)
);

create table patient_notes (
patient_notesID int generated always as identity,
patientID int NOT NULL,
practitionerID int,
date date NOT NULL,
note text NOT NULL,
Primary key(patient_notesID),
Foreign key (patientID) references patient(patientID),
Foreign key (practitionerID) references practitioner(practitionerID)
);