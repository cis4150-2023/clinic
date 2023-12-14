/*
 * Luke Alden
 * these are the insert statements for test data
 * in the database
 */
insert into patient (gender, DOB, username, passwordd, is_minor, has_gaurdian, TIN, InsuranceID, first_name, last_name, phone_number, email, state, city, street, zip_code, is_P_O_box) values 
('m', '1999-01-01','erw', 'fgh', 'f', 'f', 1234567890, 1, 'john', 'arbuckle', 0029762834, 'mhelpme@aol.com', 'vt', 'randolph', '123 death ave', 06341, 'f');

insert into practitioner (Job, DOB, username, passwordd, first_name, last_name, phone_number, email, state, city, street, zip_code, is_P_O_box) values 
('nurse', '1999-01-01', 'ef', 'efa', 'jim', 'arkbuckle', 0029762834,'mhelpme@aol.com', 'vt', 'randolph', '123 death ave', 06341, 'f');

insert into insurance (out_of_pocket_max, policyy) values
(450000.00, 2);

insert into pharmacy (pharm_name, phone_number, email, state, city, street, zip_code) values
('CVS', 1741841849, 'CVS@gmail.com', 'VT', 'Essex', '123 street', 05452),
('Rite-Aid', 1234567890, 'Rite-Aid@gmail.com', 'VT', 'Williston', '345 street', 45303),
('Walmart', 0987654321, 'Walmart@gmail.com', 'VT', 'Williston', '45 main street', 45303);

insert into lab(lab) values
('cbc'),
('cmp'),
('iron panel'),
('ferritin'),
('tsh'),
('free t4'),
('t3'),
('hgba1c'),
('lipids'),
('magnesium'),
('vitamin d'),
('vitamin b12'),
('vitamin b1'),
('vitamin b2'),
('ekg');

insert into proceduree(proceduree) values
('Appendectomy'),
('Cholecystectomy');

insert into test(test) values
('X-Ray'),
('CAT Scan'),
('MRI');

insert into recomended_labs(lab, patientid, date_recommend) values
('cbc', 2, '1999-12-20');

insert into recomended_procedures(proceduree, patientid, date_recommend) values
('Appendectomy', 2, '1999-12-22');

insert into recomended_tests(test, patientid, date_recommend) values
('CAT Scan', 2, '1999-12-23');

insert into practitioner_role(Job, permissionn) values
('nurse', 1),
('doctor', 2),
('admin', 3);

insert into a_type(aname) values
('physical'),
('appointment');


insert into medicine (generic_name, medicine_name) values
('Synthroid', 'Levothyroxine'),
('Vicodin', 'Hydrocodone/APAP'),
('Amoxil', 'Amoxicillin'),
('Prinivil',  'Lisinopril'),
('Nexium', 'Esomeprazole'),
('Lipitor', 'Atorvastatin'),
('Zocor', 'Simvastatin'),
('Plavix', 'Clopidogrel'),
('Singulair', 'Montelukast'),
('Crestor', 'Rosuvastatin'),
('Lopressor', 'Metoprolol'),
('Lexapro', 'Escitalopram'),
('Zithroma', 'Azithromycin'),
('ProAir HF',  'Albuterol'),
('HCTZ', 'Hydrochlorothiazide'),
('Glucophage', 'Metformin'),
('Zoloft', 'Sertraline'),
('Advil', 'Ibuprofen'),
('Ambien', 'Zolpidem'),
('Lasix', 'Furosemide'),
('Prilosec', 'Omeprazole'),
('Desyrel', 'Trazodone'),
('Diovan', 'Valsartan'),
('Ultram', 'Tramadol'),
('Cymbalta', 'Duloxetine'),
('Coumadin', 'Warfarin'),
('Norvasc', 'Amlodipine'),
('Percocet', 'Oxycodone/APAP'),
('Seroquel', 'Quetiapine'),
('Phenergan', 'Promethazine'),
('Flonase', 'Fluticasone'),
('Xanax', 'Alprazolam'),
('Klonopin', 'Clonazepam'),
('Lotensin', 'Benazepril'),
('Mobic', 'Meloxicam'),
('Celexa', 'Citalopram'),
('Keflex', 'Cephalexin'),
('Spiriva', 'Tiotropium'),
('Neurontin', 'Gabapentin'),
('Abilify', 'Aripiprazole'),
('K-Tab', 'Potassium'),
('Flexeril', 'Cyclobenzaprine'),
('Medrol', 'Methylprednisolone'),
('Concerta', 'Methylphenidate'),
('Claritin', 'Loratadine'),
('Coreg', 'Carvedilol'),
('Soma', 'Carisoprodol'),
('Lanoxin', 'Digoxin'),
('Namenda', 'Memantine'),
('Tenormin', 'Atenolol'),
('Valium', 'Diazepam'),
('OxyContin', 'Oxycodone'),
('Actonel', 'Risedronate'),
('Folvite', 'Folic Acid'),
('Hyzaar', 'Losartan+HCTZ'),
('Deltasone', 'Prednisone'),
('Omnipred', 'Prednisolone'),
('Fosamax', 'Alendronate'),
('Protonix', 'Pantoprazole'),
('Flomax', 'Tamsulosin'),
('Dyazide', 'Triamterene+HCTZ'),
('Paxil', 'Paroxetine'),
('Suboxone', 'Buprenorphine+Naloxone'),
('Vasotec', 'Enalapril'),
('Mevacor', 'Lovastatin'),
('Actos', 'Pioglitazone'),
('Pravachol', 'Pravastatin'),
('Prozac', 'Fluoxetine'),
('Levemir', 'Insulin Detemir'),
('Diflucan', 'Fluconazole'),
('Levaquin', 'Levofloxacin'),
('Xarelto', 'Rivaroxaban'),
('Celebrex', 'Celecoxib'),
('Tylenol#2', 'Codeine/APAP' ),
('Nasonex', 'Mometasone'),
('Cipro', 'Ciprofloxacin'),
('Lyrica', 'Pregabalin'),
('Novolog', 'Insulin Aspart'),
('Effexor', 'Venlafaxine'),
('Ativan', 'Lorazepam'),
('Zetia', 'Ezetimibe'),
('Premarin', 'Estrogen'),
('Zyloprim', 'Allopurinol'),
('Pen VK', 'Penicillin' ),
('Januvia', 'Sitagliptin'),
('Elavil', 'Amitriptyline'),
('Catapres', 'Clonidine'),
('Xalatan', 'Latanoprost'),
('Vyvanse', 'Lisdexamfetamine'),
('Advair', 'Fluticasone+Salmeterol'),
('Symbicort', 'Budesonide+Formoterol'),
('Dexilant', 'Dexlansoprazole'),
('Diabeta', 'Glyburide'),
('Zyprexa', 'Olanzapine'),
('Detrol', 'Tolterodine'),
('Zantac', 'Ranitidine'),
('Pepcid', 'Famotidine'),
('Cardizem', 'Diltiazem'),
('Lantus', 'Insulin Glargine'),
('Prinizide', 'Lisinopril+HCTZ'),
('Wellbutrin®', 'Bupropion'),
('Zyrtec®', 'Cetirizine'),
('Topamax®', 'Topiramate'),
('Valtrex®', 'Valacyclovir'),
('Lunesta®', 'Eszopiclone'),
('Zovirax®', 'Acyclovir'),
('Omnicef®', 'Cefdinir'),
('Cleocin®', 'Clindamycin'),
('Keppra®', 'Levetiracetam'),
('Lopid®', 'Gemfibrozil'),
('Robitussin®', 'Guaifenesin'),
('Glucotrol®', 'Glipizide'),
('Avapro®', 'Irbesartan'),
('Reglan®', 'Metoclopramide'),
('Cozaar®', 'Losartan'),
('Dramamine®', 'Meclizine'),
('Flagyl®', 'Metronidazole'),
('Caltrate®', 'Vitamin D'),
('AndroGel®', 'Testosterone'),
('Requip®', 'Ropinirole'),
('Risperdal®', 'Risperidone'),
('Patanol®', 'Olopatadine'),
('Aricept®', 'Donepezil'),
('Focalin®', 'Dexmethylphenidate'),
('Lovenox®', 'Enoxaparin'),
('Duragesic®', 'Fentanyl'),
('Bentyl®', 'Dicyclomine'),
('Xopenex®', 'Levalbuterol'),
('Strattera®', 'Atomoxetine'),
('Altace®', 'Ramipril'),
('Restoril®', 'Temazepam'),
('Adipex® P', 'Phentermine'),
('Accupril®', 'Quinapril'),
('Viagra®', 'Sildenafil'),
('Zofran®', 'Ondansetron'),
('Tamiflu®', 'Oseltamivir'),
('Rheumatrex®', 'Methotrexate'),
('Pradaxa®', 'Dabigatran'),
('Uceris®', 'Budesonide'),
('Cardura®', 'Doxazosin'),
('Pristiq®', 'Desvenlafaxine'),
('Humalog®', 'Insulin Lispro'),
('Biaxin®', 'Clarithromycin'),
('Buspar®', 'Buspirone'),
('Proscar®', 'Finasteride'),
('Nizoral®', 'Ketoconazole'),
('VESIcare®', 'Solifenacin'),
('Dolophine®', 'Methadone'),
('Minocin®', 'Minocycline'),
('Pyridium®', 'Phenazopyridine'),
('Aldactone®', 'Spironolactone'),
('Levitra®', 'Vardenafil'),
('Clovate®', 'Clobetasol'),
('Tessalon®', 'Benzonatate'),
('Depakote®', 'Divalproex'),
('Avodart®', 'Dutasteride'),
('Uloric®', 'Febuxostat'),
('Lamictal®', 'Lamotrigine'),
('Pamelor®', 'Nortriptyline'),
('Amaryl®', 'Glimepiride'),
('Aciphex®', 'Rabeprazole'),
('Enbrel®', 'Etanercept'),
('Bystolic®', 'Nebivolol'),
('Relafen®', 'Nabumetone'),
('Procardia®', 'Nifedipine'),
('Macrobid®', 'Nitrofurantoin'),
('NitroStat® SL', 'Nitroglycerine'),
('Ditropan®', 'Oxybutynin'),
('Cialis®', 'Tadalifil'),
('Kenalog®', 'Triamcinolone'),
('Exelon®', 'Rivastigmine'),
('Prevacid®', 'Lansoprazole'),
('Ceftin®', 'Cefuroxime'),
('Robaxin®', 'Methocarbamol'),
('Travatan®', 'Travoprost'),
('Latuda®', 'Lurasidone'),
('Hytrin®', 'Terazosin'),
('Imitrex®', 'Sumatriptan'),
('Evista®', 'Raloxifene'),
('Remeron® ', 'Mirtazepine'),
('Humira®', 'Adalimumab'),
('Cogentin®', 'Benztropine'),
('Gablofen®', 'Baclofen'),
('Apresoline®', 'Hydralazine'),
('Bactroban®', 'Mupirocin'),
('Inderal®', 'Propranolol'),
('Mycostatin®', 'Nystatin'),
('Verelan®', 'Verapamil'),
('Estrace®', 'Estradiol'),
('Dilantin®', 'Phenytoin'),
('Tricor®', 'Fenofibrate'),
('Victoza®', 'Liraglutide'),
('Brilinta®', 'Ticagrelor'),
('Voltaren®', 'Diclofenac'),
('Onglyza®', 'Saxagliptin'),
('Aleve®', 'Naproxen'),
('Zanaflex®', 'Tizanidine'),
('Amphetamine/Dextro-amphetamine',  'Adderall®'),
('Amoxicillin+Clavulanate', 'Augmentin®'),
('Ezetimibe+Simvastatin',   'Vytorin®');

insert into family_history (patientid, relationship, description) values (2, 'mother', 'bad back');