echo "===== SYSTEM ====="
hostnamectl

echo "===== CPU ====="
lscpu

echo "===== RAM ====="
free -h

echo "===== DISK ====="
lsblk
df -h

echo "===== NETWORK ====="
ip a