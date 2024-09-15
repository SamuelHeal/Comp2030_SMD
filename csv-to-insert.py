import csv

name_id_map = {
  "3D Printer": 1,
  "Automated Assembly Line": 2,
  "Automated Guided Vehicle (AGV)": 3,
  "CNC Machine": 4,
  "Energy Management System": 5,
  "IoT Sensor Hub": 6,
  "Industrial Robot": 7,
  "Predictive Maintenance System": 8,
  "Quality Control Scanner": 9,
  "Smart Conveyor System": 10
}

def convertDate(string):
  parts = string.split("/")
  parts.reverse()
  parts[2] = parts[2] if len(parts[2]) == 2 else "0"+parts[2]
  return "/".join(parts)

def convertTime(string):
  if (len(string) < 5):
    string = "0"+string
  return string

def convertTimestamp(string):
  parts = string.split(" ")
  return " ".join([convertDate(parts[0]), convertTime(parts[1])])

with open("./insert-logs.sql", "w") as output:
  with open("./factory_logs.csv", "r") as input:
    reader = csv.DictReader(input)
    for line in reader:
      output.write(f"""INSERT INTO Log VALUES(
                    {name_id_map[line["machine_name"]]},
                    \"{line["machine_name"]}\",
                    \"{convertTimestamp(line["timestamp"])}\",
                    \"{line["operational_status"]}\",
                    {"NULL" if line["maintenance_log"] == "" else f"\"{line["maintenance_log"]}\""},
                    {"NULL" if line["error_code"] == "" else f"\"{line["error_code"]}\""},
                    {line["production_count"]},
                    {line["humidity"]},
                    {line["power_consumption"]},
                    {line["pressure"]},
                    {"NULL" if line["speed"] == "" else line["speed"]},
                    {line["temperature"]},
                    {line["vibration"]}
                  );\n\r""")
      